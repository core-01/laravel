<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextReport extends Model
{
    protected $table = 'text_report';
    use HasFactory;

    public function headerRef()
    {
        return $this->hasOne(TextReport::class,'id','header_ref');
    }

    public function getHeaderRef()
    {
        return optional($this->headerRef())->first();
    }

    public function footerRef()
    {
        return $this->hasOne(TextReport::class,'id','footer_ref');
    }

    public function getFooterRef()
    {
        return optional($this->footerRef())->first();
    }

}
