<?php

// kontrak view for tim
interface KontrakViewTim
{
    public function tampilListTim($listTim): string;
    public function tampilFormTim($data = null): string;
}

?>  