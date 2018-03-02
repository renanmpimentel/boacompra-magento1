<?php

namespace Uol\BoaCompra\Domain\Core;

class Language
{
    private $language;

    /**
     * Language constructor.
     * @param $language
     * @throws \Exception
     */
    public function __construct($language)
    {
        $this->language = $language;
        $this->isValid();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    protected function isValid()
    {
        if (!array_key_exists('pt_BR', $this->getAll())) {
            throw new \Exception("Must be a valid langague, see \Uol\BoaCompra\Domain\Core\Language");
        }
        return true;
    }

    public function getAll()
    {
        return array(
            'pt_BR' => 'Brazilian Portuguese',
            'es_ES' => 'Spanish',
            'en_US' => 'English',
            'pt_PT' => 'Portugal Portuguese',
            'tr_TR' => 'Turkish',
        );
    }

    public function getIsoCode()
    {
        return $this->language;
    }
}
