<?php

namespace Youtube\Model;

use DomainException;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Filter\ToInt;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\StringLength;

class Youtube
{
    public $keywords;

    public function exchangeArray(array $data)
    {
        $this->keywords     = !empty($data['keywords']) ? $data['keywords'] : null;
    }

}