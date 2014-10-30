<?php
/**
 * This code belongs to of Opensoft company
 */

namespace Bookshelf\Core\Validation\Constraint;


use Bookshelf\Model\ActiveRecord;

class UniqueFieldConstraint implements ConstraintInterface
{
    private $model;
    private $propertyName;
    private $message = 'Это название занято';

    /**
     * @param ActiveRecord $model
     * @param string $propertyName
     * @param string|null $message
     */
    public function __construct(ActiveRecord $model, $propertyName, $message = null)
    {
        $this->model = $model;
        $this->propertyName = $propertyName;
        if ($message) {
            $this->message = $message;
        }
    }

    /**
     * @param array $errors
     * @return boolean
     */
    public function validate(array &$errors)
    {
        $accessor = 'get' . ucfirst($this->propertyName);
        $value = $this->model->$accessor();
        $query = $this->model->findBy($this->propertyName, $value);
        $property = $query->$accessor();
        if ($property) {
            $errors[$this->propertyName][] = $this->message;
        }
    }
}
