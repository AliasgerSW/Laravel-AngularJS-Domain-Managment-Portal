<?php


namespace Modules\OpenSRS\API;


class OpsEnvelope
{
    public $opsVersion = '0.9';
    public $newLine = "\n";
    public $space = '';
    public $data;



    /**
     * Converts PHP array into the OPS Xml Format
     * @param $array
     * @return string
     */
    public function encodeToXml($array)
    {
        //to convert into uppercase
        if ($array['protocol']) {
            $array['protocol'] = strtoupper($array['protocol']);
        }
        if ($array['action']) {
            $array['action'] = strtoupper($array['action']);
        }
        if ($array['object']) {
            $array['object'] = strtoupper(($array['object']));
        }

        $xmlDataBlock = $this->encodeToXmlDataBlock($array);

        $opsMsg='<?xml version=\'1.0\' encoding="UTF-8" standalone="no" ?>'.$this->newLine.
            '<!DOCTYPE OPS_envelope SYSTEM "ops.dtd">'.$this->newLine.
            '<OPS_envelope>'.$this->newLine.
            $this->space.'<header>'.$this->newLine.
            $this->space.$this->space.'<version>'.$this->opsVersion.'</version>'.$this->newLine.
            $this->space.'</header>'.$this->newLine.
            $this->space.'<body>'.$this->newLine.
            $xmlDataBlock.$this->newLine.
            $this->space.'</body>'.$this->newLine.
            '</OPS_envelope>';
        return $opsMsg;
    }

    /**
     * Convert PHP array to OPS_Envelope data block
     * @return string
     */
    public function encodeToXmlDataBlock($data)
    {
        return str_repeat($this->space, 2).'<data_block>'.$this->convertData($data, 3).$this->newLine.str_repeat($this->space, 2).'</data_block>';
    }


    /**
     * Recursively convert PHP array to XML format
     * @param $array
     * @param int $indent
     * @return string
     */
    public function convertData(&$array, $indent = 0)
    {
        $string = '';
        $IND = str_repeat($this->space, $indent);
        if (is_array($array)) {
            if ($this->isAssociativeArray($array)) {
                $string .= $this->newLine.$IND.'<dt_assoc>';
                $end = '</dt_assoc>';
            } else {
                $string .= $this->newLine.$IND.'<dt_array>';
                $end = '</dt_array>';
            }

            foreach ($array as $key => $value ) {
                ++$indent;
                if ((gettype($value) == 'resource') || (gettype($value) == 'user function') || (gettype($value) == 'unknown type')) {
                    continue;
                }

                $string .= $this->newLine.$IND.'<item key="'.$key.'"';
                if (gettype($value) == 'object' && get_class($value)) {
                    $string .= ' class="'.get_class($value).'"';
                }
                $string .= '>';

                if (is_array($value) || is_object($value)) {
                    $string .= $this->convertData($value, $indent + 1);
                    $string .= $this->newLine.$IND.'</item>';
                } else {
                    $string .= $this->quoteXmlChars($value).'</item>';
                }
                --$indent;
            }
            $string .= $this->newLine.$IND.$end;
        } else {
            $string .= $this->newLine.$IND.'<dt_scalar>'.
                $this->quoteXmlChars($array).'</dt_scalar>';
        }
        return $string;

    }


    /**
     * Determines if the array is associative or not
     * @param $array
     * @return bool
     */
    public function isAssociativeArray($array)
    {
        if (empty($array)) {
            return true;
        }

        if (is_array($array)) {
            foreach ($array as $key => $value) {
                if (!is_int($key)) {
                    return true;
                }
            }
        }

        return false;

    }

    /**
     * Eliminates Special XML characters
     * @param $string
     * @return mixed
     */
    public function quoteXmlChars($string)
    {
        $search = ['<', '>', '&', "'", '"'];
        $replace = ['&lt;', '&gt;', '&amp;', '&apos;', '&quot;'];
        $string = str_replace($search, $replace, $string);
        return $string;
    }

    /**
     * Converts xml to PHP array
     * @param $msg
     * @return null
     * @throws \Exception
     */

    public function xmlToPhpArray($msg)
    {
        $this->data = null;
        $xp = xml_parser_create();
        xml_parser_set_option($xp, XML_OPTION_CASE_FOLDING, false);
        xml_parser_set_option($xp, XML_OPTION_SKIP_WHITE, true);
        xml_parser_set_option($xp, XML_OPTION_TARGET_ENCODING, 'ISO-8859-1');

        if (!xml_parse_into_struct($xp, $msg, $vals, $index )) {
            $error = sprintf('XML error: %s at line %d',
                xml_error_string(xml_get_error_code($xp)),
                xml_get_current_line_number($xp)
            );
            xml_parser_free($xp);
            throw new \Exception("Error:".$error);
        }

        xml_parser_free($xp);
        $temp = $depth = array();
        foreach ($vals as $value) {
            switch ($value['tag']) {
                case 'OPS_envelope':
                case 'header':
                case 'body':
                case 'data_block':
                    break;
                case 'version':
                case 'msg_id':
                case 'msg_type':
                    $key = 'ops'.$value['tag'];
                    $temp[$key] = $value['value'];
                    break;
                case 'item':
                    if (isset($value['attributes'])) {
                        $key = $value['attributes']['key'];
                    } else {
                        $key = '';
                    }
                    switch ($value['type']) {
                        case 'open':
                            array_push($depth, $key);
                            break;

                        case 'complete':
                            array_push($depth, $key);
                            $p = implode("::", $depth);

                            if (isset($value['value'])) {
                                $temp[$p] = $value['value'];
                            } else {
                                $temp[$p] = '';
                            }
                            array_pop($depth);
                            break;
                        case 'close':
                            array_pop($depth);
                            break;
                    }
                    break;
                case 'dt_assoc':
                case 'dt_array':
                    break;

            }
        }
        foreach ($temp as $key => $value) {
            $levels = explode('::', $key);
            $num_levels =count($levels);
            if ($num_levels == 1) {
                $this->data[$levels[0]] = $value;
            } else {
                $pointer = &$this->data;
                for ($i = 0; $i < $num_levels; ++$i) {
                    if (!isset($pointer[$levels[$i]])) {
                        $pointer[$levels[$i]] = array();
                    }
                    $pointer = &$pointer[$levels[$i]];
                }
                $pointer = $value;
            }

        }
        return $this->data;
    }

    public function decodeInArray($response)
    {
        $opsEnvelopeMessage = '';
        if (is_resource($response)) {
            while (!feof($response)) {
                $opsEnvelopeMessage .= fgets($response, 400);
            }
        } else {
            $opsEnvelopeMessage = $response;
        }
        return $this->xmlToPhpArray($opsEnvelopeMessage);

    }




}