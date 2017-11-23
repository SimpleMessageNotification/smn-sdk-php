<?php
/**
 * Copyright (c) 2012 Nate Good <me@nategood.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

/**
 * Handlers are used to parse and serialize payloads for specific
 * mime types.  You can register a custom handler via the register
 * method.  You can also override a default parser in this way.
 */

namespace Http\Handlers;

class MimeHandlerAdapter
{
    public function __construct(array $args = array())
    {
        $this->init($args);
    }

    /**
     * Initial setup of
     * @param array $args
     */
    public function init(array $args)
    {
    }

    /**
     * @param string $body
     * @return mixed
     */
    public function parse($body)
    {
        return $body;
    }

    /**
     * @param mixed $payload
     * @return string
     */
    function serialize($payload)
    {
        return (string) $payload;
    }

    protected function stripBom($body)
    {
        if ( substr($body,0,3) === "\xef\xbb\xbf" )  // UTF-8
            $body = substr($body,3);
        else if ( substr($body,0,4) === "\xff\xfe\x00\x00" || substr($body,0,4) === "\x00\x00\xfe\xff" )  // UTF-32
            $body = substr($body,4);
        else if ( substr($body,0,2) === "\xff\xfe" || substr($body,0,2) === "\xfe\xff" )  // UTF-16
            $body = substr($body,2);
        return $body;
    }
}
