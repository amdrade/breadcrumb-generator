<?php

class Breadcrumb {

    private $aItem;

    public function __construct() {
        $this->aItem  = [];
    }

    public static function createFromArray(array $aBreadcrumb): Breadcrumb {
        $oBreadcrumb = new Breadcrumb();

        foreach ($aBreadcrumb as $aNode) {
            $sTexto = $aNode['texto'];
            if (empty($sTexto)) {
                continue;
            }
            $sLink = $aNode['link'] ?? "";
            $oBreadcrumb->add($sTexto, $sLink);
        }

        return $oBreadcrumb;
    }

    public function add(string $sTexto, string $sLink = "") {
        $this->aItem[] = $this->createNode($sTexto, $sLink);

        return $this;
    }

    private function createNode($sTexto, $sLink) {
        $aNode = [];
        $aNode['texto'] = $sTexto;
        $aNode['link'] = $sLink;

        return $aNode;
    }

    public function getHtml(): string {
        $sHTML = "";
        if (empty($this->aItem)) {
            return "";
        }

        $sHTML .= "<nav aria-label=\"breadcrumb\">";
        $sHTML .= "<ol class=\"breadcrumb\">";
        $iNivel = count($this->aItem) - 1;
        foreach ($this->aItem as $iItem => $aNode) {
            if ($iNivel == $iItem) {
                $sHTML .= "<li class=\"breadcrumb-item\" aria-current=\"page\">{$aNode['texto']}</li>";
            } else {
                $sHTML .= "<li class=\"breadcrumb-item\"><a href=\"{$aNode['link']}\">{$aNode['texto']}</a></li>";
            }
        }
        $sHTML .= "</ol>";
        $sHTML .= "</nav>";

        return $sHTML;
    }

    public function addFirst(string $sTexto, string $sLink) {
        $aNode = $this->createNode($sTexto, $sLink);
        array_unshift($this->aItem, $aNode);

        return $this;
    }

    public function addLast(string $sTexto, $sLinkLast = "") {
        $aNode = $this->createNode($sTexto, "");
        $iItem = count($this->aItem) - 1;
        $this->aItem[$iItem]['link'] = $sLinkLast;
        array_push($this->aItem, $aNode);

        return $this;
    }

    public function addAfter(int $iPosition, $sTexto, $sLink) {
        $aNode = $this->createNode($sTexto, $sLink);
        array_splice($this->aItem, $iPosition, 0, [$aNode]);

        return $this;
    }

    public function addBefore(int $iPosition, $sTexto, $sLink) {
        $aNode = $this->createNode($sTexto, $sLink);
        $iPosition = $iPosition > 0 ? $iPosition - 1 : 0;
        array_splice($this->aItem, $iPosition, 0, [$aNode]);

        return $this;
    }


    public function remove(int $iPosition) {
        $iPosition -= 1;
        if (isset($this->aItem[$iPosition])) {
            unset($this->aItem[$iPosition]);
        }

        return $this;
    }
}
