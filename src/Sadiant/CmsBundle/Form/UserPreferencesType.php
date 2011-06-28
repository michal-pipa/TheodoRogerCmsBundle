<?php

namespace Sadiant\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

use Sadiant\CmsBundle\Entity\User;
use Sadiant\CmsBundle\Entity\Role;
use Sadiant\CmsBundle\Repository\UserRepository;

class UserPreferencesType extends AbstractType
{
    protected $is_new;

    /**
     * Form constructor
     * 
     * @author Vincent Guillon <vincentg@theodo.fr>
     * @since 2011-06-27
     */
    public function __construct($is_new = true)
    {
        $this->is_new = $is_new;
    }
    
    /**
     * Form builder
     * 
     * @author Vincent Guillon <vincentg@theodo.fr>
     * @since 2011-06-27
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        // Set inputs
        $builder->add('name', 'text', array('required' => true));
        $builder->add('username', 'text', array('required' => true));
        $builder->add('email', 'text', array('required' => true));

        $builder->add('password', 'password', array('required' => false));
        $builder->add('password_confirm', 'password', array('required' => false));
        
        $builder->add('language', 'choice', array(
            'choices'   => UserRepository::getAvailableLanguages(),
            'required'  => false
        ));

        // Salt hidden field
        if ($this->is_new)
        {
            $builder->add('salt', 'hidden', array('required' => true));
        }
    }
   
    /**
     * Form default options
     * 
     * @author Vincent Guillon <vincentg@theodo.fr>
     * @since 2011-06-27
     */
    public function getDefaultOptions(array $options)
    {
        return array(
           'data_class' => 'Sadiant\CmsBundle\Entity\User',
        );
    }
}
