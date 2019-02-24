# veiron-website 

Website for the veiron game.

**This source code is already some years old and badly programmed.**

## Useful Links
* **Downloads** - <https://github.com/tomxpcvx/veiron-website/releases>

### Requirements
* Git
* Webserver with php 5.4 

### Checkout sources
Open a shell and type:
```
git clone https://github.com/tomxpcvx/veiron-website.git
cd veiron-website/
```

### Folder structure
```
├── veiron-website/                 
    ├── api/                            # representation of api subdomain
        ├── get/                        
            ├── ...                     # getter will be copied here
        ├── set/
            ├── ...                     # setter will be copied here
    ├── assets                          # representation of assets subdomain
        ├── launcher                    # Sources for the launcher to be loaded from it
            ├── ...
        ├── website                     # Sources for the website to be loaded from it
            ├── php
                ├── ...                 
            ├── js
                ├── ...
            ├── css
                ├── ...
    ├── website                         # representation of main domain
        ├── ...
    ├── download                        # representation of download subdomain
        ├── VeironLauncher.jar          # actual newest version of veiron-launcher
```

## Contribute
Thank you for your interest in a contribution, but this project is dead and no longer supported.

## License
veiron-website is licensed under the Unlicense license. Please see [`LICENSE`](https://github.com/tomxpcvx/veiron-website/blob/master/LICENSE) for more info.
