<?php

/**
 * This file is part of the OpenPNE package.
 * (c) OpenPNE Project (http://www.openpne.jp/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file and the NOTICE file that were distributed with this source code.
 */

class SnsConfig extends BaseSnsConfig
{
  protected static $snsConfigSettings = array();

  public function construct()
  {
    if (!self::$snsConfigSettings) {
        self::$snsConfigSettings = sfConfig::get('openpne_sns_config');
    }

    return parent::construct();
  }

  public function getConfig()
  {
    $name = $this->getName();
    if ($name && isset(self::$snsConfigSettings[$name]))
    {
      return self::$snsConfigSettings[$name];
    }

    return false;
  }

  public function getValue()
  {
    $value = $this->_get('value');

    if ($this->isMultipleSelect())
    {
      $value = unserialize($value);
    }

    return $value;
  }

  public function setValue($value)
  {
    if ($this->isMultipleSelect())
    {
      $value = serialize($value);
    }

    $this->_set('value', $value);
  }

  protected function isMultipleSelect()
  {
    $config = $this->getConfig();

    return ('checkbox' === $config['FormType']);
  }
}
