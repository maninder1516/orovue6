<?php

namespace IZMO\ExtendUIBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class IZMOExtendUIBundle extends Bundle
{
    public function getParent() {
        return 'OroUIBundle';
    }
}
