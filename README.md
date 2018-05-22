OAuth2 ESIA bundle
==================

Configuration and symfony services for [ekapusta/oauth2-esia](https://github.com/ekapusta/oauth2-esia).


Install
-------

`composer require ekapusta/oauth2-esia-bundle`

In your kernell add to other bundles:

`new Ekapusta\OAuth2EsiaBundle\EkapustaOAuth2EsiaBundle(),`


Configuration
-------------

### Signer

Decide [which signer to use](https://github.com/ekapusta/oauth2-esia#which-signer-to-use) and
set these params in your config:

```yaml
ekapusta_oauth2_esia.signer.class_name: Ekapusta\OAuth2Esia\Security\Signer\OpensslCli
ekapusta_oauth2_esia.signer.certificate_path: /path/to/your/certificate/with/public-key-inside.cer
ekapusta_oauth2_esia.signer.private_key_path: /path/to/your/certificates/private.key
ekapusta_oauth2_esia.signer.private_key_password: 'some password'
ekapusta_oauth2_esia.signer.tool_path: /path/to/your/openssl
```

### Provider

You must configure your `client_id` and `redirect_uri`.

```yaml
ekapusta_oauth2_esia.client_id: SOMESYSTEM
ekapusta_oauth2_esia.redirect_uri: https://your-system.domain/auth/finish
```

Scopes should be configured if you need more info from authorized user.
Please note, that you should set here only scopes, for which you have permission to use.
Full list of scopes are at [methodical recommendations](http://minsvyaz.ru/ru/documents/?type=50&directions=13).

```yaml
ekapusta_oauth2_esia.default_scopes: ['openid', 'fullname', '...']
```


### Test mode

To use test mode put your provider to test portal as:

```yaml
ekapusta_oauth2_esia.remote_url: 'https://esia-portal1.test.gosuslugi.ru'
ekapusta_oauth2_esia.remote_certificate_path: '%ekapusta_oauth2_esia.vendor.resources_path%/esia.test.cer'
```


### Logging

Currently logger is used only at transport level: injected into guzzle http client.
You can configure your own logger class by `ekapusta_oauth2_esia.logger.class` param.
Or just redefine at your config service `ekapusta_oauth2_esia.logger`.


Usage
-----

There are two DI-services available: `ekapusta_oauth2_esia.provider` and `ekapusta_oauth2_esia.service`.
When you need just authorize user and get information, then you could use `ekapusta_oauth2_esia.service`.
In other cases use `ekapusta_oauth2_esia.provider`. 2nd is just a simplified facade for 1st.
