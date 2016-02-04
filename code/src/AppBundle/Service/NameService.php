<?php

namespace AppBundle\Service;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class NameService
 * @package AppBundle\Service
 * @author Raymond Feng <raymond@studionone.com.au>
 */
class NameService
{
    protected $name = 'Raymond';
    protected $session;

    /**
     * NameService constructor.
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $lastName
     * @return string
     * @throws \Exception
     */
    public function appendLastName($lastName = null)
    {
        if (is_null($lastName)) {
            throw new \Exception('You must provide a name');
        }

        return $this->name . ' '  . $lastName;
    }

    /**
     * @param $name
     */
    public function temporarilySaveName($name)
    {
        dump($this->session->get('name'));
        $this->session->set('name', $name);
    }
}