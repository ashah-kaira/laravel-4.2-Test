<?php
namespace DataProviders;
 
use Illuminate\Support\ServiceProvider;
 
class BaseServiceProvider extends ServiceProvider {
 
  public function register()
  {
    $app = $this->app;
	$app->bind('DataProviders\ISecurityDataProvider','DataProviders\SecurityDataProvider');
    $app->bind('DataProviders\IGroupDataProvider','DataProviders\GroupDataProvider');

  }
 
}