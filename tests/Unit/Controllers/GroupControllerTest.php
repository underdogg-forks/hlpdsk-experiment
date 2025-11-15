<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\Admin\helpdesk\GroupController;
use App\Model\helpdesk\Agent\Groups;
use App\Services\GroupService;
use App\User;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Mockery;
use Tests\TestCase;

class GroupControllerTest extends TestCase
{
    protected $groupService;
    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $faker = FakerFactory::create();

        // Create and authenticate user
        $str = Str::random(10);
        $password = Hash::make($str);
        $email = $faker->unique()->email();
        $this->user = new User([
            'first_name'   => $faker->firstName(),
            'last_name'    => $faker->lastName(),
            'email'        => $email,
            'user_name'    => $faker->unique()->userName(),
            'password'     => $password,
            'active'       => 1,
            'role'         => 'admin',
            'agent_tzone'  => 81,
        ]);
        $this->user->save();

        $this->actingAs($this->user);
        $this->assertAuthenticated();
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function it_displays_groups_index_page()
    {
        $response = $this->get(route('groups.index'));
        $response->assertStatus(200);
    }

    public function it_displays_create_group_form()
    {
        $response = $this->get(route('groups.create'));
        $response->assertStatus(200);
    }

    public function it_creates_a_new_group_with_valid_data()
    {
        $groupData = [
            'name'              => 'Test Group ' . time(),
            'group_status'      => 1,
            'can_create_ticket' => 1,
            'can_edit_ticket'   => 1,
            'can_post_ticket'   => 1,
            'can_close_ticket'  => 1,
            'can_assign_ticket' => 1,
            'can_delete_ticket' => 0,
            'can_ban_email'     => 0,
            'can_manage_canned' => 1,
            'can_manage_faq'    => 1,
            'can_view_agent_stats' => 1,
            'department_access' => 1,
            'admin_notes'       => 'Test notes',
        ];

        $response = $this->post(route('groups.store'), $groupData);

        $response->assertStatus(302);
        $response->assertRedirect('groups');
    }

    public function it_displays_edit_group_form()
    {
        $group = Groups::first();
        
        if ($group) {
            $response = $this->get(route('groups.edit', $group->id));
            $response->assertStatus(200);
        } else {
            $this->markTestSkipped('No groups available for testing');
        }
    }

    public function it_updates_an_existing_group()
    {
        $group = Groups::first();
        
        if ($group) {
            $groupData = [
                'name'              => 'Updated Group ' . time(),
                'group_status'      => 1,
                'can_create_ticket' => 1,
            ];

            $response = $this->put(route('groups.update', $group->id), $groupData);
            $response->assertStatus(302);
        } else {
            $this->markTestSkipped('No groups available for testing');
        }
    }

    public function it_deletes_a_group_successfully()
    {
        // Create a test group
        $group = Groups::create([
            'name'              => 'Test Group to Delete ' . time(),
            'group_status'      => 1,
            'can_create_ticket' => 1,
        ]);

        $response = $this->delete(route('groups.destroy', $group->id));
        $response->assertStatus(302);
    }
}
