<?php

namespace App\Hateoas;

use App\Models\Stand;
use GDebrauwer\Hateoas\Link;
use GDebrauwer\Hateoas\Traits\CreatesLinks;

class StandHateoas
{
    use CreatesLinks;

    public function self(Stand $stand): ?Link
    {
        return $this->link('stands.show', ['stand' => $stand]);
    }

    public function update(Stand $stand): ?Link
    {
        return $this->link('stands.update', ['stand' => $stand]);
    }

    public function delete(Stand $stand): ?Link
    {
        return $this->link('stands.destroy', ['stand' => $stand]);
    }
}
