<?php

declare(strict_types=1);

/**
 * @author enea dhack <hello@enea.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App;

class Message
{
    private $message;

    private $status;

    public function __construct(string $message, string $status)
    {
        $this->message = $message;
        $this->status = $status;

        session()->flash('message', $this);
    }

    public static function make(string $message, string $status)
    {
        return new static($message, $status);
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getStatusClass(): string
    {
        return $this->classes()[$this->status] ?? 'info';
    }

    private function classes(): array
    {
        return [
            'created' => 'primary',
            'deleted' => 'danger',
        ];
    }
}
