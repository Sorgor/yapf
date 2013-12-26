<?php

interface yapf_Interface_Parser
{
    public function getSections();

    public function fromSection($section, $varName);

}