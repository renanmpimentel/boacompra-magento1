# BoaCompra Magento Module (Magento CE 1.9)

## BoaCompra official module for Magento
This module enable Boa Compra payment method in Magento that allows your store to integrate your checkout with Boa Compra.

## Getting Started

### Prerequisites
* Magento 1.9.0.0 to 1.9.3.7
* PHP 5.6.4+

### Installing
> **ATTENTION** We recommend that you back up your Magento store prior to any installation or upgrade of the module.

- Make sure there is no installation of other modules for BoaCompra on your system;
- Download the latest module version **[here](https://github.com/boacompra/boacompra-magento1/raw/master/Uol_BoaCompra-1.0.0.tgz)** or download the repository as a zip file through the GitHub button;
- In the administrative area of your Magento, go to the menu `System -> Magento Connect -> Magento Connect Manager`.
- In the Magento Connect Manger section, under the Direct package file upload section, click `Choose file`, select the file *Uol_BoaCompra-xxx.tgz* (previously downloaded), click the upload button and follow the installation of the module in the page console;
- At the end of the process the BoaCompra module will be installed on your Magento! Proceed to the [next section](#configuration) to configure and start using the module.


### Configuration
> The sections and paths names in Magento may vary depending on the version and the translation of your store.

To configure the module go to the administrative panel of your store `System -> Configuration`. On the configuration screen, choose the `Sales -> Payment Methods` option in the left panel, then look for the `BoaCompra` section, fill in all the required fields and enable BoaCompra default checkout.

## Address (optional)
In order for the user address to be fully sent in some countries through the BoaCompra (like in brazilian address) module the clients address must be configured as follows:
- Access through the administrative panel of your store: `System -> Configuration`. On the Configuration screen, access `Customers -> Customer Configuration -> Name and Address Options`
- Change the *Number of Lines in a Street Address* to 4.
  - The BoaCompra Module will wait for the address as follows:
    - address1 = address
    - address2 = number
    - address3 = complement
    - address4 = neighborhood

## License
See the [LICENSE](LICENSE) file on license rights and limitations (Apache License 2.0).
