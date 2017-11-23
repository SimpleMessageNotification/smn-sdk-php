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
 * Mime Type: text/csv
 * @author Raja Kapur <rajak@twistedthrottle.com>
 */

namespace Http\Handlers;

class CsvHandler extends MimeHandlerAdapter
{
    /**
     * @param string $body
     * @return mixed
     * @throws \Exception
     */
    public function parse($body)
    {
        if (empty($body))
            return null;

        $parsed = array();
        $fp = fopen('data://text/plain;base64,' . base64_encode($body), 'r');
        while (($r = fgetcsv($fp)) !== FALSE) {
            $parsed[] = $r;
        }

        if (empty($parsed))
            throw new \Exception("Unable to parse response as CSV");
        return $parsed;
    }

    /**
     * @param mixed $payload
     * @return string
     */
    public function serialize($payload)
    {
        $fp = fopen('php://temp/maxmemory:'. (6*1024*1024), 'r+');
        $i = 0;
        foreach ($payload as $fields) {
            if($i++ == 0) {
                fputcsv($fp, array_keys($fields));
            }
            fputcsv($fp, $fields);
        }
        rewind($fp);
        $data = stream_get_contents($fp);
        fclose($fp);
        return $data;
    }
}
