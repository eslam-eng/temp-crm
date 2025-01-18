<?php

namespace App\Vendors\Multitenancy\TenantFinder;

use Illuminate\Http\Request;
use Spatie\Multitenancy\Contracts\IsTenant;

class DomainTenantFinder extends \Spatie\Multitenancy\TenantFinder\DomainTenantFinder
{
    public function findForRequest(Request $request): ?IsTenant
    {
        $host = $request->segment(1);
        return app(IsTenant::class)::whereDomain($host)->first();
    }
}
