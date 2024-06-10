# ArubaHiSpeedCache

Documento ad uso interno con note per lo sviluppo.

La versione 2 ha visto una completa riscrittura della base di codice del plugin e l'aggiunta di alcune funzionalità necessarie per lo sviluppo del plugin stesso.

Per il refactoring del codice siamo stati ispirati da synfony core e ci siamo impegnati a utilizzre il pattern SOLID.

# Spercitiche tecniche.

Il plugin dovrà essere compatibile con versione di php >= 5.6
Il Plugin dovrà essere compatibile con versione di wordopress >= 5.4

# Note per lo sviluppo

Le implementazioni di nuove funzionalità o correnzione di bug dovranno avvenire in un nuovo branch, che verrà nomito con la versione successiva del plugin.

E' prevista la squequente semantica di versioni per il plugin.

1.x.x <-- Modifiche sostanziali del pacchetto
x.1.x <-- Aggiunta di funzionalità
x.x.1 <-- correzzione di bug.

# Prima di apertura QA/Rilascio

Prima dell'apertur della QA o del rilascio del plugin si deve prestare molta attenzione al controllo avanzamento di versione del plugin nei seguenti file:

-   readme.txt (rigo 8)
-   aruba-hispeed-cache.php (rigo 14)
-   includes\ArubaHiSpeedCacheConfigs.php (var PLUGIN_VERSION)

**Per l'apertura della QA fare riferimento a questo task**
https://jira.aruba.it/browse/QA-11477

```
[Basic Info]
	Project = Tester & QA (QA)
	Issue Type = Test Queue
	Summary = WP Plugin Aruba HiSpeed Cache v1.1.0
	Description = ...
	Iniziative Type = a piacere.
	Change log = è tutto un altro film
	Component/s = CMS, Hosting e Domini
	Business Line = Hosting e Domini
	Servizio = Wordpress
	Referente = Lorenzo Lattanzi
	Assignee = Thomas Camaran
	Test di contabilità = none
	Security Fix = none
	Applicativi IAM = none
	Intervento su architettura = No

[Deploy info]
	Repositories: none per il momento
	Repository Path: Per questo {secondo} rilascio viene allegato lo .zip con la soluzione da testare e caricare sul svn di wordpress
	Deploy Type: manual
	Deploy release path: Il pacchetto non è gestito, attualmente, attraverso buildmaster (Tale gestione sarà aggiunta successivamente).

[Other Info]
	Allega il file zip tutto il resto vuoto

[Security Info]
	vuoto
```

> Per il momento non è ancora previsto un taskRunner come buildmaster quindi le QA avvengono fornendo il pacchetto di installazione del plugin.

# Preparazione del pacchetto
Dalla versione 2.0.0 è stato creato un sistema di build .net presente in /bin/wp-plugin-builder un programma che legge le impostazioni presenti nel file composer.json ed esegue il build dei file in una cartella di destinazione.

Le impostazioni sono le seguenti

```
	"wp-build-config": {
		"entry": "/",
		"output": "c:/cartella di detinazione/aruba-hisepped-cache/",
		"files": [
			"index.php",
			"uninstall.php",
			"readme.txt",
			"aruba-hispeed-cache.php",
			"app",
			"languages"
		],
		"exclude": [
			"app\\src\\Admin\\AdminClassTest.php"
		]
	}
```

per avviare il processo di build eseguire il sequente comanto dal terminale
```
dotnet bin\wp-plugin-builder\wp-plugin-builder.dll
```

o in alternativa

```
dotnet bin\wp-plugin-builder\wp-plugin-builder.dll c:/cartella di detinazione/aruba-hisepped-cache/
```


# Localizzazione e Internazionalizzazione.

Per generare il file .pot del plugin installare wp-cli e da console far girare questo comando

```cmd
wp i18n make-pot . languages/aruba-hispeed-cache.pot --exclude="..git"
```

> forse non più necesasrio. **Consigliato da fare**

# Note sulla compatibilità WordPress

| Funzione/azione/filtro             | introdotta in wp |
| ---------------------------------- | ---------------- |
| admin_enqueue_scripts              | 2,8,0            |
| network_admin_menu                 | 3,1,0            |
| network_admin_plugin_action_links  | 3,1,0            |
| admin_menu                         | 1,5,0            |
| plugin*action_links*{$plugin_file} | 2,7,0            |
| admin_bar_menu                     | 3,1,0            |
| wp_insert_comment                  | 2,8,0            |
| transition_post_status             | 2,3,0            |
| edit_term                          | 2,3,0            |
| delete_term                        | 2,5,0            |
| check_ajax_referer                 | 2,1,0            |
| admin_bar_init                     | 3,1,0            |
| wp_parse_url                       | 4,4              |

# Note sulla compatibilità PHP

filter_input_array dalla versione php 5.4 accetta bool $add_empty = true, (uso in <code>includes\ArubaHiSpeedCacheAdmin.php</code>) senza si perdono le impostazioni secondarie quando disabilita la prima opzione. (https://www.php.net/manual/en/function.filter-input-array.php)

## test effettuati per classe checker

```php
//test
require_once \ARUBA_HISPEED_CACHE_BASEPATH . 'includes' .\AHSC_DS. 'HiSpeedCacheServiceChecker.php';
$wpGestito = new \ArubaHiSpeedCache\includes\HiSpeedCacheServiceChecker('https://www.wpgestitotop.it/');
$t = $wpGestito->check();
var_dump($t, $wpGestito);

$wpServerLinux = new \ArubaHiSpeedCache\includes\HiSpeedCacheServiceChecker('http://www.insoftware.it/');
$tt = $wpServerLinux->check();
var_dump($tt, $wpServerLinux);

$externalsite = new \ArubaHiSpeedCache\includes\HiSpeedCacheServiceChecker('https://www.google.it/');
$ttt = $externalsite->check();
var_dump($ttt, $externalsite);
```

#  Controllo sul codice
per controllare se esiste del codice copiato di troppo.
.bin/phpcpd --exclude=./vendor ./

#  Per generare un report dettagliato
.bin/phpmetrics --report-html=./ahsc-php-report.html ./

#  PHPAssumptions analyser
.bin/phpa ./includes or phpa ./
