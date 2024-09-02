<?php

namespace IZMO\ExtendUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class IZMOExtendUserBundle extends Bundle
{
    public function getParent() {
        return 'OroUserBundle';
    }
}
