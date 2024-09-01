<?php

namespace IZMO\ExtendAccountBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class IZMOExtendAccountBundle extends Bundle
{
    public function getParent(){
        return 'OroAccountBundle';
    }
}
