<?php
class Template
{
  public $assignedValues = array();
  public $tpl;

  function __construct($filename = "")
  {
    if (!empty($filename)) {
      if (file_exists($filename)) {
        $this->tpl = file_get_contents($filename);
      } else {
        exit("ERROR: template file not found!");
      }
    }
  }

  function assign($searchFor, $replaceWith)
  {
    if (!empty($searchFor)) {
      $this->assignedValues[strtoupper($searchFor)] = $replaceWith;
    }
  }

  function assignTable($searchFor, $replaceWithTable, $replaceWithHeader)
  {
    $table = "";
    if (!empty($searchFor)) {
      if (!empty($replaceWithTable)) {
        $rows = count($replaceWithTable);
        if ($rows > 0) {
          $table .= "<table>";
          $head = count($replaceWithHeader);
          if ($head > 0) {
            $table .= "<thead><tr>";
            foreach ($replaceWithHeader as $h) {
              $table .= "<th>";
              $table .= $h;
              $table .= "</th>";
            }
            $table .= "</tr></thead>";
          }
          $table .= "<tbody>";
          for ($i = 0; $i < $rows; $i++) {
            $table .= "<tr>";
            $table .= "<td>";
            $table .= $replaceWithTable[$i]->code;
            $table .= "</td>";
            $table .= "<td>";
            $table .= $replaceWithTable[$i]->name;
            $table .= "</td>";
            $table .= "<td>";
            $table .= $replaceWithTable[$i]->ects;
            $table .= "</td>";
            $table .= "<td>";
            $table .= $replaceWithTable[$i]->term;
            $table .= "</td>";
            $table .= "</tr>";
          }
          $table .= "</tbody>";
          $table .= "</table>";
        }
      }
      $this->assign($searchFor, $table);
    }
  }

  function render()
  {
    if (count($this->assignedValues) > 0) {
      foreach ($this->assignedValues as $key => $value) {
        $this->tpl = preg_replace("/\{" . $key . "\}/", $value, $this->tpl);
      }
    }
    return $this->tpl;
  }
}
?>