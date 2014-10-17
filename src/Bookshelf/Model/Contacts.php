<?php
/**
 * Created by PhpStorm.
 * User: aleksandr.kolobkov
 * Date: 17.10.2014
 * Time: 20:18
 */

namespace Bookshelf\Model;


use Bookshelf\Controller\ContactsController;
use Bookshelf\Core\Db;

/**
 *
 * Class Contacts
 */
class Contacts extends ActiveRecord
{
    /**
     * Property for user contact name
     *
     * @var string
     */
    private $contactName;

    /**
     * Property for value of user contact
     *
     * @var
     */
    private $value;

    /**
     * Property for id of user contact
     *
     * @var
     */
    private $id;

    /**
     * Property very storage user id who had this contact
     *
     * @var
     */
    private $userId;

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * @param mixed $name
     */
    public function setContactName($name)
    {
        $this->contactName = $name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

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
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Function that build string for user account page there he can see all his contacts
     * And if need can change his contacts
     *
     * @param $userId
     * @return string
     */
    public function getContactDataForm($userId)
    {
        $array = $this->getContactDataForUser($userId);
        $contact = new ContactsController();
        $contactData="";
        foreach ($array as $value) {
            $contactData .= $contact->renderContactDataForm($value);
        }

        return $contactData;
    }

    /**
     * Function that return array with all property value for contact with $id
     *
     * @return array
     */
    protected function getState()
    {
        return ['name' => $this->contactName, 'value' => $this->value, 'user_id' => $this->userId, 'id' => $this->id];
    }

    /**
     * @return string
     */
    protected function getTableName()
    {
        return 'contacts';
    }

    /**
     * Method that set value in property for class instance
     *
     * @param $array
     */
    protected function setState($array)
    {
        $this->contactName = $array['name'];
        $this->value = $array['value'];
        $this->userId = $array['user_id'];
        $this->id = $array['id'];
    }

    /**
     * Method that return all contacts that have user with $userId
     *
     * @param $userId
     * @return array
     */
    private function getContactDataForUser($userId)
    {
        $db = Db::getInstance();
        $resultArray = $db->fetchBy($this->getTableName(), ['user_id' => $userId]);
        $contacts = [];
        foreach ($resultArray as $value) {
            $contacts["{$value['id']}"] = new Contacts();
            $contacts["{$value['id']}"]->setState($value);
        }
        return $contacts;
    }
}
