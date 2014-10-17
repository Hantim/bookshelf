<?php

namespace Bookshelf\Controller;

use Bookshelf\Core\Db;
use Bookshelf\Core\Templater;
use Bookshelf\Core\TemplaterException;
use Bookshelf\Model\Contancts;
use Bookshelf\Model\User;
use Exception;
/**
 * @author Aleksandr Kolobkov
 */
class MainController
{
    /**
     * @var string default name for controller
     */
    private $controllName='Main';

    /**
     * @var var for templater instance
     */
    private $templater;

    /**
     * Magic function that create templater instance
     */
    public function __construct()
    {
        try {
            $this->templater = new Templater();
        } catch(TemplaterException $e) {
            throw new Exception ('Controller error');
        }
    }

    /**
     * Return default action for $this controller
     */
    public function defaultAction()
    {
        $this->indexAction();
    }

    /**
     * When execute will show Main/IndexView.html
     */
    public function indexAction()
    {
        $contacts = new Contancts('Skype', 'trallmall');
        $contacts->save();

        var_dump($contacts);
        $login = new LoginController();
        $actionName = 'index';
        $param = array(
            "title" => 'Test',
            "text" => 'This is test so relax and be happy',
            "menu" => $login->getLoginForm()
        );
        $this->templater->show($this->controllName, $actionName, $param);
    }
}

