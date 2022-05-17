<?php

namespace Todo;

use SplSubject;

interface ItemInterface extends Identifiable, SplSubject, Tickable
{
}
