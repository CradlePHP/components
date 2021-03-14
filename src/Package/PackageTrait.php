<?php //-->
/**
 * This file is part of the Cradle PHP Project.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\Package;

/**
 * If you want to utilize composer packages
 * as plugins/extensions/addons you can adopt
 * this trait
 *
 * @vendor   Cradle
 * @package  Package
 * @standard PSR-2
 */
trait PackageTrait
{
  /**
   * @var array $packages A safe place to store package junk
   */
  protected $packages = [];

  /**
   * Custom Invoker for package calling
   *
   * @param *string $package name of package
   *
   * @return Package
   */
  public function __invokePackage(string $package): Package
  {
    return $this->package($package);
  }

  /**
   * Returns all the packages
   *
   * @param string|null $name Name of package
   *
   * @return array
   */
  public function getPackages(string $name = null)
  {
    if (isset($this->packages[$name])) {
      return $this->packages[$name];
    }

    return $this->packages;
  }

  /**
   * Returns true if given is a registered package
   *
   * @param *string $vendor The vendor/package name
   *
   * @return bool
   */
  public function isPackage(string $vendor): bool
  {
    return isset($this->packages[$vendor]);
  }

  /**
   * Returns a package space
   *
   * @param *string $vendor The vendor/package name
   *
   * @return PackageTrait
   */
  public function package(string $vendor)
  {
    if (!array_key_exists($vendor, $this->packages)) {
      throw PackageException::forPackageNotFound($vendor);
    }

    return $this->packages[$vendor];
  }

  /**
   * Registers and initializes a plugin
   *
   * @param *string $vendor   The vendor/package name
   * @param ?string $root     The path location of the package
   * @param string $bootstrap A file to call on when a package is registered
   *
   * @return PackageTrait
   */
  public function register(
    string $vendor,
    ?string $root = null,
    ?string $bootstrap = null
  )
  {
    //if no bootstrap file name defined and theres a getBootstrapFileName method
    if (is_null($bootstrap) && method_exists($this, 'getBootstrapFileName')) {
      //use that
      $bootstrap = $this->getBootstrapFileName();
    }

    //if still no bootstrap file name defined
    if (is_null($bootstrap)) {
      //set it to something at least...
      $bootstrap = 'bootstrap';
    }

    //determine class
    if (method_exists($this, 'resolve')) {
      $this->packages[$vendor] = $this->resolve(Package::class, $this, $vendor, $root);
    // @codeCoverageIgnoreStart
    } else {
      $this->packages[$vendor] = new Package($this, $vendor, $root);
    }
    // @codeCoverageIgnoreEnd

    $path = $this->packages[$vendor]->getPackagePath();

    if (!$path) {
      return $this;
    }

    //let's try to call the bootstrap
    $cradle = $this;

    $file = sprintf('%s/%s', $path, $bootstrap);

    // @codeCoverageIgnoreStart
    if (file_exists($file)) {
      //so you can access cradle
      //within the included file
      include $file;
    } else if (file_exists($file . '.php')) {
      include $file . '.php';
    }
    // @codeCoverageIgnoreEnd

    return $this;
  }
}