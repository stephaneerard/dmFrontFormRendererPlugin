<?php

class dmFrontFormSection implements Iterator {
    
    protected $sectionLabel, $fields;
    
    private $position;
    
    public function __construct(array $fields, $sectionLabel) {
        $this->position = 0;        
        $this->sectionLabel = $sectionLabel;
        $this->configure($fields);        
    }
    
    protected function configure(array $fields) {
        $this->fields = array();
        foreach ($fields as $field) {
            $this->fields[] = $this->configureField($field);
        }
    }

    protected function configureField($field) {
        // TYPE : form_field, separator, subsection
        // TODO : type: nested_form???
        if (is_array($field)) {
            return array(
                'name'          =>          $field['name'],
                'type'          =>          (isset ($field['type'])) ? $field['type'] : 'form_field',
                'is_big'        =>          (isset($field['is_big'])) ? $field['is_big'] : ($field['type'] == 'separator' || $field['type'] == 'subsection' || $field['type'] == 'nested_form') ? true : false,
                'options'       =>          (isset ($field['options'])) ? $field['options'] : null
            );
        } else {
            return array(
                'name'          =>          $field,
                'type'          =>          'form_field',
                'is_big'        =>          false,
                'options'       =>          null
            );
        }
    }

    public function getSectionLabel() {
        return $this->sectionLabel;
    }

    public function setSectionLabel($sectionLabel) {
        if ($sectionLabel == "") return $this; // TODO throw error?
        $this->sectionLabel = $sectionLabel;
        return $this;
    }

    public function getFields() {
        return $this->fields;
    }

    public function setFields(array $fields) {
        $this->fields = $fields;
        return $this;
    }    
    
    public function current() {
        return $this->fields[$this->position];
    }
    public function key() {
        return $this->position;
    }
    
    public function next() {
        ++$this->position;
    }
    public function rewind() {
        $this->position = 0;
    }
    public function valid() {
        return isset($this->fields[$this->position]);
    }
    
}
