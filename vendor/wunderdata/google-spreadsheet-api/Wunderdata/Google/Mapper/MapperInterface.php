<?php

namespace Wunderdata\Google\Mapper;

interface MapperInterface
{
    /**
     * @param \DOMElement $node
     * @return mixed
     */
    public function mapXmlToObject(\DOMElement $node);
}