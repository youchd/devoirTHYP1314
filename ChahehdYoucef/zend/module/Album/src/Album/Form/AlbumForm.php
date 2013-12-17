<?php
// module/Album/src/Album/Form/AlbumForm.php:
namespace Album\Form;

use Zend\Form\Form;

class AlbumForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('album');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'note',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'note',
            ),
        ));
        $this->add(array(
            'name' => 'nom_prenom',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'nom_prenom',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
}