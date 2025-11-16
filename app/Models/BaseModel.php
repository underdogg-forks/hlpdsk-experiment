<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * BaseModel
 * 
 * Base model class that all application models should extend.
 * Provides common functionality and structure for all models.
 *
 * @author Ladybird <info@ladybirdweb.com>
 */
class BaseModel extends Model
{
    /**
     * Set a given attribute on the model.
     *
     * @param string $property
     * @param mixed $value
     * @return mixed
     */
    public function setAttribute($property, $value)
    {
        // Placeholder for HTML purification logic if needed
        // Currently disabled but can be enabled for security purposes
        parent::setAttribute($property, $value);
    }
}
