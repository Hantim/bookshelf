<?php
/**
 * Created by PhpStorm.
 * User: aleksandr.kolobkov
 * Date: 17.10.2014
 * Time: 19:19
 */

namespace Bookshelf\Model;

class User extends ActiveRecord
{
    /**
     * Property for user firstname
     *
     * @var
     */
    private $firstName;

    /**
     * Property for user lastname
     *
     * @var
     */
    private $lastName;

    /**
     * Property for user email
     *
     * @var
     */
    private $email;

    /**
     * Property for user password
     *
     * @var
     */
    private $password;

    /**
     * Property for user id
     *
     * @var
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email string
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Return all property for user
     *
     * @return array
     */
    protected function getState()
    {
        return ['firstname' => $this->firstName, 'lastname' => $this->lastName, 'email' => $this->email, 'password' => $this->password, 'id' => $this->id];
    }

    /**
     * @return string
     */
    protected function getTableName()
    {
        return 'users';
    }

    /**
     * Set value in user instance class from array
     *
     * @param $array
     */
    protected function setState($array)
    {
        $this->firstName = $array['firstname'];
        $this->lastName = $array['lastname'];
        $this->email = $array['email'];
        $this->password = $array['password'];
        $this->id = $array['id'];
    }
}
