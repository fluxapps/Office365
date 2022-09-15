# M365File Plugin for ILIAS

Short description

This is an OpenSource project by fluxlabs ag, (https://fluxlabs.ch)

This project is licensed under the GPL-3.0-only license

## Getting Started

### Requirements

* ILIAS 5.4.0 - 6.999
* PHP >=7.0

### Installation

Start at your ILIAS root directory

```bash
mkdir -p Customizing/global/plugins/Services/Repository/RepositoryObject
cd Customizing/global/plugins/Services/Repository/RepositoryObject
git clone https://github.com/studer-raimann/M365File.git M365File
```

Update, activate and config the plugin in the ILIAS Plugin Administration

### Configuration

#### Microsoft Azure
To allow the plugin to authenticate and authorize against the Microsoft API, an application with the correct permissions has to be configured in Microsoft Azure AD:
1. Login at https://portal.azure.com/ (Admin permissions required)
2. Open the *App Registrations* and add a *New Registration*
3. Enter an arbitrary name for the application and choose the option *Single tenant* (should be pre-selected)
4. In the applications *Overview*, write down (or rather copy) the *Application (client) ID* and *Directory (tenant) ID* for later  
5. Navigate to *API permissions* and add the following permission:
    * Microsoft Graph -> Delegated Permissions ->
      Files.ReadWrite.All
6. To confirm the permission, click *Grant admin constent for xxx*
7. Navigate to *Certificates & secrets* and generate a *New client secret* (expiry date and description of your choice) -> write down or memorize the generated client secret

#### Plugin Configuration
The plugin uses the OAuth2.0 Resource Owner Password Credentials Flow. That means the plugin will send requests on behalf of a user without any interaction of this user (not even for authentication). Therefore the plugin requires the credentials (login and password) of such a user. All files and folders created by the plugin will be stored in this user's drive, which means that the user needs to have a personal drive in Sharepoint/OneDrive.

This leads to the following plugin configuration:
* *Tenant ID*: see [Microsoft Azure](#microsoft-azure)
* *Client ID*: see [Microsoft Azure](#microsoft-azure)
* *Client Secret*: see [Microsoft Azure](#microsoft-azure)
* *Username*: name of aforementioned user
* *Password*: password of aforementioned user
