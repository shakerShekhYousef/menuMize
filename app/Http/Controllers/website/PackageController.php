<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Package;

class PackageController extends Controller
{
    //Get all packages function
    public function index()
    {
        //Get all packages
        $packages = Package::all();
        //Response
        return success_response($packages);
    }

    //Show package
    public function show(Package $package)
    {
        //Response
        return  success_response($package);
    }
}
