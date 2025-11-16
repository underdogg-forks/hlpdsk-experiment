   {!! Form::open( array('route' => 'settings.create','method' => 'post', 'id' => 'form-add-setting' ) ) !!}
     
    <label for="setting_name">'Setting Name:' </label>
    {!! Form::text( 'setting_name', '', array(
        'id' => 'setting_name',
        'placeholder' => 'Enter Setting Name',
        'maxlength' => 20,
        'required' => true,
    ) ) !!}
    <label for="setting_value">'Setting Value:' </label>
    {!! Form::text( 'setting_value', '', array(
        'id' => 'setting_value',
        'placeholder' => 'Enter Setting Value',
        'maxlength' => 255,
        'required' => true,
    ) ) !!}
     
    {!! Form::submit( 'Add Setting', array(
        'id' => 'btn-add-setting',
    ) ) !!}
     
    </form>

