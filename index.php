<?php

// Page created by Shepard [Fabian Pijcke] <Shepard8@laposte.net>
// Arno Esterhuizen <arno.esterhuizen@gmail.com>
// and Romain Bourdon <rromain@romainbourdon.com>
// and Herv� Leclerc <herve.leclerc@alterway.fr>
// Icons by Mark James <http://www.famfamfam.com/lab/icons/silk/>



//chemin jusqu'au fichier de conf de WampServer
$wampConfFile = 'wampmanager.conf';

//chemin jusqu'aux fichiers alias
$aliasDir = '../alias/';



// // on charge le fichier de conf locale
// if (!is_file($wampConfFile))
//     die ('Unable to open WampServer\'s config file, please change path in index.php file');
// //require $wampConfFile;
// $fp = fopen($wampConfFile,'r');
// $wampConfFileContents = fread ($fp, filesize ($wampConfFile));
// fclose ($fp);


//on rs les versions des applis
preg_match('|phpVersion = (.*)\n|',$wampConfFileContents,$result);
$phpVersion = str_replace('"','',$result[1]);
preg_match('|apacheVersion = (.*)\n|',$wampConfFileContents,$result);
$apacheVersion = str_replace('"','',$result[1]);
preg_match('|mysqlVersion = (.*)\n|',$wampConfFileContents,$result);
$mysqlVersion = str_replace('"','',$result[1]);
preg_match('|mariadbVersion = (.*)\n|',$wampConfFileContents,$result);
$mariadbVersion = str_replace('"','',$result[1]);
preg_match('|wampserverVersion = (.*)\n|',$wampConfFileContents,$result);
$wampserverVersion = str_replace('"','',$result[1]);



// repertoires  gnorer dans les projets
$projectsListIgnore = array ('.','..');


// textes
$langues = array(
	'pt-br' => array(
		'langue' => 'Português Brasileiro',
		'autreLangue' => 'Vers&atilde;o Inglesa',
		'autreLangueLien' => 'en',
		'titreHtml' => 'P&aacute;gina inicial',
		'titreConf' => 'Configura&ccedil;&atilde;o Servidor',
		'versa' => 'Vers&atilde;o Apache:',
		'versp' => 'Vers&atilde;o PHP:',
		'versm' => 'Vers&atilde;o MySQL:',
		'versma' => 'Vers&atilde;o MariaDB:',
		'phpExt' => 'Exten&ccedil;&otilde;es carregadas : ',
		'titrePage' => 'Ferramentas',
		'txtProjet' => 'Seus Projetos',
		'txtNoProjet' => 'Não existe projeto.<br />Crie um projeto e solte na pasta \'www\'.',
		'txtAlias' => 'Your Aliases',
		'txtNoAlias' => 'No Alias yet.<br />To create a new one, use the WAMPSERVER menu.',
		'faq' => 'http://www.en.wampserver.com/faq.php'
	),
	'en' => array(
		'langue' => 'English',
		'autreLangue' => 'Version Fran&ccedil;aise',
		'autreLangueLien' => 'fr',
		'titreHtml' => 'WAMPSERVER Homepage',
		'titreConf' => 'Server Configuration',
		'versa' => 'Apache Version :',
		'versp' => 'PHP Version :',
		'versm' => 'MySQL Version :',
		'versma' => 'MariaDB Version :',
		'phpExt' => 'Loaded Extensions : ',
		'titrePage' => 'Tools',
		'txtProjet' => 'Your Projects',
		'txtNoProjet' => 'No projects yet.<br />To create a new one, just create a directory in \'www\'.',
		'txtAlias' => 'Your Aliases',
		'txtNoAlias' => 'No Alias yet.<br />To create a new one, use the WAMPSERVER menu.',
		'faq' => 'http://www.en.wampserver.com/faq.php'
	),
	'fr' => array(
		'langue' => 'Fran?s',
		'autreLangue' => 'Portuguese Version',
		'autreLangueLien' => 'pt-br',
		'titreHtml' => 'Accueil WAMPSERVER',
		'titreConf' => 'Configuration Serveur',
		'versa' => 'Version de Apache:',
		'versp' => 'Version de PHP:',
		'versm' => 'Version de MySQL:',
		'versma' => 'Version de MariaDB:',
		'phpExt' => 'Extensions Charg&eacute;es: ',
		'titrePage' => 'Outils',
		'txtProjet' => 'Vos Projets',
		'txtNoProjet' => 'Aucun projet.<br /> Pour en ajouter un nouveau, cr&eacute;ez simplement un r&eacute;pertoire dans \'www\'.',
		'txtAlias' => 'Vos Alias',
		'txtNoAlias' => 'Aucun alias.<br /> Pour en ajouter un nouveau, utilisez le menu de WAMPSERVER.',
		'faq' => 'http://www.wampserver.com/faq.php'
	)
);



// images
$pngFolder = <<< EOFILE
iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAABhlBMVEX//v7//v3///7//fr//fj+/v3//fb+/fT+/Pf//PX+/Pb+/PP+/PL+/PH+/PD+++/+++7++u/9+vL9+vH79+r79+n79uj89tj89Nf889D88sj78sz78sr58N3u7u7u7ev777j67bL67Kv46sHt6uP26cns6d356aP56aD56Jv45pT45pP45ZD45I324av344r344T14J734oT34YD13pD24Hv03af13pP233X025303JL23nX23nHz2pX23Gvn2a7122fz2I3122T12mLz14Xv1JPy1YD12Vz02Fvy1H7v04T011Py03j011b01k7v0n/x0nHz1Ejv0Hnuz3Xx0Gvz00buzofz00Pxz2juz3Hy0TrmznzmzoHy0Djqy2vtymnxzS3xzi/kyG3jyG7wyyXkwJjpwHLiw2Liw2HhwmDdvlXevVPduVThsX7btDrbsj/gq3DbsDzbrT7brDvaqzjapjrbpTraojnboTrbmzrbmjrbl0Tbljrakz3ajzzZjTfZijLZiTJdVmhqAAAAgnRSTlP///////////////////////////////////////8A////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////9XzUpQAAAAlwSFlzAAALEgAACxIB0t1+/AAAAB90RVh0U29mdHdhcmUATWFjcm9tZWRpYSBGaXJld29ya3MgOLVo0ngAAACqSURBVBiVY5BDAwxECGRlpgNBtpoKCMjLM8jnsYKASFJycnJ0tD1QRT6HromhHj8YMOcABYqEzc3d4uO9vIKCIkULgQIlYq5haao8YMBUDBQoZWIBAnFtAwsHD4kyoEA5l5SCkqa+qZ27X7hkBVCgUkhRXcvI2sk3MCpRugooUCOooWNs4+wdGpuQIlMDFKiWNbO0dXTx9AwICVGuBQqkFtQ1wEB9LhGeAwDSdzMEmZfC0wAAAABJRU5ErkJggg==
EOFILE;
$pngFolderGo = <<< EOFILE
iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAAK/INwWK6QAAABl0RVh0U29mdHdhcmUAQWRvYmUgSW1hZ2VSZWFkeXHJZTwAAAJISURBVDjLpZPLS5RhFIef93NmnMIRSynvgRF5KWhRlmWbbotwU9sWLupfCBeBEYhQm2iVq1oF0TKIILIkMgosxBaBkpFDmpo549y+772dFl5bBIG/5eGch9+5KRFhOwrYpmIAk8+OjScr29uV2soTotzXtLOZLiD6q0oBUDjY89nGAJQErU3dD+NKKZDVYpTChr9a5sdvpWUtClCWqBRxZiE/9+o68CQGgJUQr8ujn/dxugyCSpRKkaw/S33n7QQigAfxgKCCitqpp939mwCjAvEapxOIF3xpBlOYJ78wQjxZB2LAa0QsYEm19iUQv29jBihJeltCF0F0AZNbIdXaS7K6ba3hdQey6iBWBS6IbQJMQGzHHqrarm0kCh6vf2AzLxGX5eboc5ZLBe52dZBsvAGRsAUgIi7EFycQl0VcDrEZvFlGXBZshtCGNNa0cXVkjEdXIjBb1kiEiLd4s4jYLOKy9L1+DGLQ3qKtpW7XAdpqj5MLC/Q8uMi98oYtAC2icIj9jdgMYjNYrznf0YsTj/MOjzCbTXO48RR5XaJ35k2yMBCoGIBov2yLSztNPpHCpwKROKHVOPF8X5rCeIv1BuMMK1GOI02nyZsiH769DVcBYXRneuhSJ8I5FCmAsNomrbPsrWzGeocTz1x2ht0VtXxKj/Jl+v1y0dCg/vVMl4daXKg12mtCq9lf0xGcaLnA2Mw7hidfTGhL5+ygROp/v/HQQLB4tPlMzcjk8EftOTk7KHr1hP4T0NKvFp0vqyl5F18YFLse/wPLHlqRZqo3CAAAAABJRU5ErkJggg==
EOFILE;
$gifLogo = <<< EOFILE
iVBORw0KGgoAAAANSUhEUgAAAfUAAAEpCAYAAACKtLtFAAAACXBIWXMAAA7EAAAOxAGVKw4bAABR20lEQVR4Xu2dB4AkRdn
+O/fkjXfcHUlAkGAgBxEFJEiSTz9E/RsIBhBBSYpi9gNEMtyBgBzpjgMEASXnJIiBnJEgOVzcNLFn+v9UzfTe7NzsTp6d8L
Qus7fTXeFX1f30W/XWW4rCgwRIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIg
ARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARI
gARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgAR
IgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgA
RIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIg
ARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIoMsJqF1e
f1a/ywlomqkrijuouBm/q7j4UZNAksDflimuGy3Ao+HfmW5EpumW6rqZQXAJuK4bwKcDDnHFVVbg95ECJuK54nYjJ9aZBKa
bgDHdBWD+zScQ8of3MC19B+T8p+VDK54opwS6Yq6l6+oBrpJ5J5VOX45ndqqc6+pxTm+4d0Pd0L6lqupDS5YtvaG6NFUIsi
sFWdXM9QzT/Jxp6LvruvZxXVPnxGIxM5FIKIahKz6fD+do72Uy7pspx3nYcZw7M+nUQ1kBUyBYKn6yaU112MHAIch1ViaVe
SoZj19f6vxGfK/r9qambewFRU6n05nLksn4uyXyGX9xUTVjTcMwdzUtcy/T0DbXNW1ONBq14vE4OBmSk2maK5Dua4lU6h8p
J3Vnxkk9CE6Ls3msZF6qbqFwZA5eqL6maTpeBlRFQ2O78jeRjJqFromiid8UfIcKZdKolIP/ZHRxLtokjesVDY2qo7Nqmkg
Fh/gGJ2Rc8T95IDEkguKh7X347aWlS969erIyhiL9A5m08x1kkca1Duou0kfqMv1c2njlQYcRaYuilGstybNRNCRlIKERLa
NeNjy6rPBlckLR/P7gRk4m8wXkkUolnWHkvABFm/KaUvyr/d6y/Z9DBTaT17vKq+hfk3KsNg9eRwIkMAkBS7PFU1HpifT8W
dyCkXDkB+XCMhVjH3nbZn+OKve6Ws7r6+mTz8aeUPhrIt+B/v5bqktPl+kYqrmFz/JdDTGCJZ6ti2VZbk9P5INwOPRsOBx8
DJ/PRCKRt/AjvxfaIj7x98WWbZ2h6dq62TJA/UscdsD/My8PPOU/U+r8+n+v9vh8/udEGULB0AOl09c8Th8Bp/mBQEAIhaw
/hMzt6+tb3tvb8wJ4PYGfZ3p7e9/E3yZwCoVCQ+B0vmqom6zklOU/1RHy+3fJ5+3l28hPCLMs+2qrzXphqrKFQz0fb2TZ8P
IhyzE4OOj29Q6sWYpVMBD8ltcmWT7q3qWuacT3pmH50Ude99oI5fp7I/JhmpURoKVeGa+2PltYoUkMLsPIEEPMwvYpaW33+
3u1ZbEVGUVX00paEZaZAsv1d66rPo6R6PsaCcSAGSUfGDCIRD7CUqosPwPXOa6w2zRVP0Ez1GPjibgOwVYUTbs67TrXwFJ6
Ip5KvJ+IJka9tH0ByweLq9/2m2vAGtve1K3944nEtslk8ihc+8NEMnEiTL6TwTJqGj415cSLDjUnorETfaHApvHR6H6BYHB
+NBbbWslkllVWh2rOliMJeGGxz4zHYxsFg8G3E0nn/5VOKQPxtn9i28YJY2NjesgKKSj3zbCIF8E2fjSRir8bHY0Ne+kEQ7
YNfn3+oLk6bOttdM38XxirOycTyUMg7ockndQ8cPxFKpFcoem2lkknJh3d0C39pR5f5FeKq8Gczrh4eRJmMJrJs7WzfUB0A
5wgf3FgrqaSqTQa9/DR0dE5kUjPAljqT+uGEZJWOy5FOtKeFqa5MKKFZey9mSKJDATVh74xpagrWtbw7u/vT48NR3+OkQvd
MHX5V5QP3VNTXUEcf5Dp53qDV+Dxkk9sADnkkOvXLsphoIjDtmWskONBUxzozvI+EKMluBcV2+f7XiIeu6l0+9bnjGAwpI6
NjYr7cl+M3KwlRmzE6A3+XXL0qj4lYCokQAKSQMgfkpZ6f1/vn8TDsSfc8/1SaPog6uIc2zD3EtfgBpbPRNv2vYLHGeZYG3
fMGBjIjSyEvi7yhFVYwYPLlE9MjE7ACAzcIa4X1qY/6L9S91sfqbTUfr+9XTgcvsmzqoS1GgoGPzxZOv2RHpk/puzXhDnzt
sjftKz5leZb7fmmZnxZ5Cl+NN3ct1Q6lu7T/b7AIu8a1PVWX8C/aanrCr/HC8EngqHgFV4/gWX/WiDoyw7PNuiI9PT8Q5R7
oH+GsPbrfoR7wtJSH+gfyE0r1D2LihKMhMMHivLMmjXrA4yWJMVoE/6dGxmpKKmaTsaL272iHBj5e0x8BoIBWuo1Ea3PxbT
U68OxLVLJGbxiLrHkcKhXITFHKA6YOvItvLe379lkMrF42bJlO/pt39xYIv7VhlXeM3k826ci16uUPNvwGYui0bFd8QBSoo
nEt2NjMSmsdiAo51xjoyOTWhd9vb0a6q+uGBpKx2IJPLASe/t9vv1hqV04NDT8CVhu/wyq6k5jo6NPFjJYNjzk9obD6oqRk
TeTSvIwfH9DKpk8WDP0OzJOuqHzjrpmrGP57XmpMQfz3v7zYK3/pVQb6aZ+QSw+9lUxEqOq+k9HRkZO9q7p7etVVyxfMSn9
3p6ImONWh4ZHMomE8yR+voYh+AU9PT0Xr1gx9CF8PhQI6btHR8ceLFWOvoE+tIuYPochjDlv8QlLWFiych78zTfelOVYc+2
19Tdff11arBhGt3Lp+sTnWmuta7/xxqtiiqWuB24b00tw9dmr6yhO5q133i7KZdaaa0oDXfoC5O42OWAgbyYxcCDvKfGl/K
sw9FFp95WXXy7Zy4En22cz6sN4bYthBOkrhm78PyftiOmephymbn4CoyM74kV7RHP1hch0M7RTU/JmJiRAAjkCkWBE3nWYm
74GH7DUe0ta6mErew0s9d3FNYMDA3evvuYas/HwHxL/hjuSECyMUJp1v6MH+vpkmpFwQM6pQ2RvLKcxTc0vn522YR0jrhPW
tW7ZIg0Fjj0l58KL5dHb02uEQ0FZHp9tbwihekOkPWPGjDG/bc2ZrFxhvDyI7zBCME+cj+H7Zbqhr1NOPao9B0Pmt4m8QqH
wUxamPUulYxu2GJqXVr3PFxDMlGBuVKfUtYXfo35qKBiQjG2fPaent+dp2XaYe/f5rYZYk30D/ZgKQlsMzNpT5PuhNT9c9k
trOfWDpf6xXFuLPj/tR19P5ABRnsHe/mt6whHhqwGfj/D76JyYdmjO4fP7zpT5+gMXBAOBnbL9LfRQc3JnLlMRqPuDmLhbm
EDW6UtaCfmfU5UYHr3ya/j1yk9YZD1vv/nWu/A6lmJu2tZZmOPbOqOk6j6fJlyVs5lWxjSVibm2Zs40bPN4WUbTmpdOJq6w
fQEtmYhVOC+fzXvF0ApnZHQsEw4GDcyvvxCNjuzQ1983Fksk7oUpOemwrGlkjTvXSf8YLwLPDA8P9wX8gQsrq1EZZ2tZZzT
LtI+Kjo3tDgcmJRl3vpVMxqb2pLb9hh2wfy2uhTPdX+Lx6OnhYFgfi41W1Z6onzs6Fk2HQkE9EU+8g1GSncDpHcyDPwpD7q
0yalLxKd6AjvCGFxfDYq04jakuEDPlrXR492/GTQeHRobvDwT8L2BkZSYsfTnNoirZqadGHRhBGcToiHxJxlz+hclU1leio
Zk2qjIdmC5FvQMbtZ5VGh8Bz74PKPBNksOa8GW6AkO858NBxvTZvssUVTgn1ffAUh2Z4ErXo9Lp+8xg1hI31H3h7NXv9/tH
UilXDiUn4tGqhCo/15ExjGnjSKUyr0cTIxtlMskvYWh+UofDZcMr3D4Mw8cTyWg0PnawEFs8gHexbPuHsphwtCtdq6nPUHU
4BELQ4L61BYTz97J90pnjkk7sX5NdGQxEZL4Zxd0TQrw+5mWVRCL9G/G3kbGRql588vMaHR2TaWDJ1ZKx5Oi2qXRit9hYsiGWrgcwk8mKeSZdc/EnYGstSZf3g1c++caIdX2Xik/LZx8i/61kp57qfcAhL+snoqufHxsdmxEKBJ9Nuu6jmC4Ji7/nVg/WO1umVyEBinqFwDrj9En8caeunHxQCM9k77SMk/mxP+B/GtbYhlgWfEbd2VTxaIqnsmKCee/dZHld5Ra8h7xtWbWLZ2H9EmPOm9HReKxUvZePjLiRUEBNJZx/pTLOceJ827LOxNvQVs4knvOl0sz/3k07rt+0DDi2XYS19iYs7rvg5X/KVGmgGeUD2rBM6VwGx8e/pZyYGMau+5EcTb0ZHYk3zus/p+pilbgoPEaXan5RqjuEOiYoF8OLvg05F59xJ3UVhr4TsWhsB0MztqxjVhOSSsSzqzzgePo98ZlOpf8oPuFr4E1pdTT3RnGtd7oU9XoT7bD08nRV3rDeAyVo+XUnlRpB0JaD8IY+lnZS34GX9UFSKDS7Ljd3nkVSMVUMEQqPZQWxSYRn9LRbEcOjUYkyFU+eEu6J3AVrXcUIx3wVLvEVV67YBZp6EtLcFCMBy+CoJi22qY5YPOsgaOi6XAmQTDpyPjTgy/oNtNnh9bfs6IM3bVOnSmD4vS79uU7FyZsKy0Y3dNPu65h6uEr8Div6QPmJQAH1yi8/HV03thsdGdkSc/jDmFK5Tuafi7I47hHYiIyZZtkE2vEGLrtyPLGQgDeZXgsZLw0tg+XcOu7oR3FbHy1SNE39XERq29LJJKqwsacoUxWpibl/kSIedu+Jz0QiVvPQey3UxLV94ZCEByv623goLhkZGvoYFiefVGu68ETeE3P7PxLpJB3nu1g3/yqmHcp6qONB3C+uw/ys9AuotyDWWjdevyoBTEvlLPWV36FPnS/+5fP7D8Ia+tUzrlPFXVOaNhzkDpVnZdwFCSf5pvw9N0/G4ffS/JpxBkW9GZRbLI+ynvYFZfZsFW9VzlhiDJ7vZsZSDSz7Ui70BXxXYXjOD8/w+fCM9zeiypU8pWDle95StigLgqpUU+26VmP5yKgbCQY1WOuvx1Nx+XBMJRPHYAgcoTarOyzD6jdsQ3jWiyAkf3SSSREtUMEISrm4JCecLEcMnEz7+TsVNuwHS98pt+7lQa9vauXlWeSs1Wetlhsty37piagPfhmw1h/BOvF/wj8iAGv6i/L7Oq9IMXRzDcQEEvEPxND7JV4Rc+8YMkce00+Aoj79bdC8EhTec1Xcg/lv4yOJETfpQgakOKWOwNDvf7F29eOmYZwm/mbVKKRVFG+cJZaxvSP+gVhychkVAp/Xklzd2mh4bCwTCiIKXTz152A4KNfMY0nQRRDkygL5qFkPZ90y5mEudR0EuHk+5aSPrbSgGMl4PcdpI/HpOLU7E1ZahlY/39N0b+ppusqb584yoQiIFCnntJOJhLTWbduWL4xwmKvL6BT6VtZBztD2x0uDDZ+NB6PJ2KORQG6qJjdP5r3wTxcf5pslQFHvyp4wrm+lha7Qp66Ij13ACqiYu14SS8W/gQeKgnCoh2Ep19eTTsK1zewDoaqjMK8yLKYgyiLySjnJu3MPuC+quoqdxcTLh1V9WaqqQPGLRseyDkdYFvgDrON+cWjF0Op4EfpDRVm4KVfXzQNj0ehXBfNEyvkONlMZD+FaKq0gosFIIUgl/yk5meYXNNOcmb0u0FbPhcJu0d+btWjrdpTR7+qW1xQJeYGgVvE1QXAecZnjpG/AtMu7w0PDG2Np487ib6pae59HH3MtE7EZbUv6ajgpJ9dXsXsOj5Yj0FY3b8vRa7sCVW6qr7wi+1uxp2U0GXV9COripjJ/wxrhn4jzMKR8nmFZGyZSWQexmo5KHtG5qFaJZPIGER0NIwfrIvZ7duMa1W2ZCIqRcEiPRxMIpT52oFhOhnLuZ/l8B5XipOtZL35DMzf0+axzxe/pjPtTBEGvKPDHWHRUek4jPvsNmN93YYGFsDTpFzJ/PdNezwVP5XI9beVwcCma5X3fKpb6e4sXZ+fSV7mjVNdvyYA/y4HiCtmEhv7d7LnJ2u8/kY6i7DYyPLJBTyTyHhLNBoHCQkr5Ucn9WR5ynlUDgfa6eWuoKC+Vt/gEDGXdi6ucVPwWjueCusBi/70v6L8Fb/dhWJ+XYQ119d7dVTwtxhLYaELU1HH/oVm6iHGP7TX1kxCD/evYLRbryQ30+fpHv6u0fw2PjKaDQb+aTjiPpNXMT8X1WOZ2LqzlKePSp9NZK98OWBdgHX4gGArd76SS4yFdKy2Hm0y/Coens8V1TiJ5uG6bRyvpuKNICy+7q1+7HbWsmihW1yq6YVOQjb9s4L5GmFj5T4y8XCJD62rq/2Lp2aR7E1RaQNtvy2BTsNLnYwOk0Ug24mBO1Nuym1SKoG3OZ2u0TVPVoaBVvLPnolWXFdUt7A9nvbvjie/CS/Y9CPvWiHNWteDU6niTiCcPR8jUF7F2GwtptQUYPThN0R0EycnONYrIW6piTdsQ4thY1pkNwn5yIBy8c2R42I9h8JKbvmCP858h+Men4cOwIh5Pim04azqw09ePQ5GwXPqXTqROt/y+BfCBhFe8t6uaEPjah3FrKuSUF+c6tvcCWkU/nyp57x5oWe9u1HckNiz7NGJHPIcNdG7FC58BYZdR37Rc2ORq+SN63AbYaW8fETgJQY2wd7uYX9fd4bERSZpL2aol25jrKOqN4dqSqdb5WbdKHUdiI27AxDBgOvN2IhH/lrAYIBhH4aGwf1VAxk2kssYUVs0inVmcSMZ2hFfwEykY6U4ydUwoEHoBy+6OgNP+oIi85SpJOQytIgQdRB6Le5srXtiDWlYuGo8dii1SV+BFaHvdNGR422IHTt4GBT0he03i0LSTfKUqtnkXZVJpOOHH90Tc9vvEn5Ox+NfDvsBrhm0fDyRr4C/oOvnDuFnHrJY9quwukzLP9cNWEfVVRg4K4tgifsQFoi6YfjokGAz7MwibXEtbGaZxAF6MxQ6018eS8RfDwQg2KhoaT1NubcujZQhQ1FumKZpXkOru8PKuiqaiaQtPAUR4vQUOanINNqz2C7Ht6XqV1jDvWVH1QyOdyryXdOLbwpnsd4i65Y6OjM7GQ++ccCD0pu3zX6bpxucQMzvsYt91iDwW93riJYbpGxPAI5/DWHRMbGerYfDg1Wgyu8wNm+ScCHbbZ8+b8MAMiGVr4gVFbuOaqd9ub8lEahn2S98F65yPg7g7mGMPO4nEib1BcAoErtUM638Q2aQvW6b8OKzZmPOtcDSqIJ7XO15S5fOyN9Sr9key2wKXe4SCYRXOiWrAH1Sxxe2Eooq/hXKjXOWmJ3uGd3LBrQmT/XbE3n9lxYoVsxFdT25yo2vVRVTEFr4hOL0eINJIJlPZPQsKNnmkplfSajyXBOpIIIyHkUhucHDgWny4vT19h5dKPmBmd2nDshm5S1tvb//Dpa4JWtkgKwhJrmOHK+HA5cIKfVCDgpa6Nv977F8t04mEg3KXNuwdXdYubZPlYdrqBlhIf2YwGBCBVlw8jOQPxH45vIavwuY039Atc51Vr2+8JYIwrdL6xW5uYvgdu7mFX4RpJGNqC5TiPyjrXPEdXgKeVzW9pxKWlZxrB8y1/AHfCeAigotIRuITDnUjCAt8Azh9WzXNDSpJs5Hn9vb3PS7K1xPp3UPk0xeZWVd9D4WDcpe2mTNnNi7UbQWAgiH/N+T90NNzq7gs5MtOe+Uf6OM/F+fgvru9gqRXORWbIYmtlcXugi9hiWrR+zcc9O0lzsEuinIKh8f0EqjoITu9RWXuNRPw3GbLM7onZudNW5bxuMQGHm7IDmqjibE0dgw7MBgKPo454E9hWcxvk5n0pEPLhfVbumxpNSUtiimICGtjsdhLKSVxlBUwTvAFrD2xJGw/uPrsAs/zXgjXl2GRfRk7qSlpn/sIrJLrHSeFvc+dJ4r5G9fcFgUJYLpCTgPAEenYSE/k01iWtIHts34PvwDhoCS+2xflOxwjHvBZSGJpUWao3mWQAhEMGaNjo9hWNvVzK2CebPutPQQnzCvvhjC0gpMox74QC0XzB55IpFLXYYrl9kza+bcIut6IMpVMs7CXlNFHS6Y54YRs6KVoNNoX6em9DtNJGvwadJEtvpDfrYzHnvVG9f4uk8l9mf2Q2xN5fxEnI3EsyzD0iJvOLFq6bMnFJctWRv2cdHoRhPi3KPNu2DzoE1jD/mTJdIucgJe4w1JDSdEvL8ASVSfoC6lj8awzqnes3DC+mhx4DQmQQNUEQsGerKU+4FnqveVY6vIaxLeQlnpfX2lL3StgyJfdu1wzVLlfNx6GsPr0vSutAJZ/VbSf+lTpQ4wmzAfbIXsOth79EgJszMd3r3hWqSgvlpq5oXD4UQx1/xBj4rMqLXel54shWikIhroDxFtax/jZIxjw4/kcEVYiGBq/rDTdas4PhLLr2L0DnGbYAd8+4HQePO6fF22ZK5+LuVs30tPzPMTjeNXU160mv1qu6e2baKnXklaxa0PhwKairvl9w6t7PT49lgODg1LQ115jrSmH9lGeb4p8PUs9aK9qqYt0MMIg4sG7cHCTmy35rOLnTcYL+7R8QlwfDkeituVbc7LzesIBcU+7/X201Ovd96pJj5Z6NdTa9JqVwStya9uqs4PLsBOygLCBWTpg20Y0kVhkWMb2TtI5DN7ol2Ab0i0RKOX1UhgH+wfVJcuW4GFa6szyv4dXsLSIIdYIb5tRMYIgIs9dI358QSwU85sb6Yq+m2Fa+2DuXWxesTm+2xwW/Kmw9P+I5WNngF7NzmnFSjwKb2IRsx0hXh/M6Omf4ZwT8aJxXtrNvD6Gfdjx+wMo/2/Lr231Z0ZHs+vYJScY4OAkpizE9MeN4ITotPpHLNXc1TCsvfH9TsNDQxuK8mLI/sSk7izA0qpT4TD5dPUlqOjKAvf3iq4teTIsaTkCMTAwkBheMbSnpkPuDOFv4brwMMfeQXAhE6qWfSXL/lfcYhPNdS8f7zaUBm624BrSwaJLQ3tV/Ov1t96ocMSj+I2MTXpEhLkv4+X0YGzw8rvRsWEZ37/cw/Tb301Eo8LZdWEiGX9TzP1HY2OrZrbSobWOd2q5peR5JNDFBLw9tAf6+4WIub2R3u+XwoE59ez8+EpL/e+lrin2PUJMYmQ39ITI1/b7b4c5WtLRSIi6SKuelnqxsoVCEbXQMhXn2X5zQ4jszzGX/LJnpUFYU7DaxbrykuWvhlP+NX6f/17BS/ygHEOqaky5hr3W/EpdLzgFQ+FVPN/BaV3M8x8FTk9DnLzyZiBTp2FfzmCpdGv9vqev9zHByJtTrzW9wuthGYsd/9zBwcGWmFMPRSZa6oGcD0vxvh2U/gYQ5G+L76c6N/967JUwE/frcnGtrpnbTsW0JxLKWep9Mjohj+kl0PAH0/RWj7nnEygIvFUQimYSVrl371pewSP+oIb1s6PYSewgy7awYVpsN1g4JefWPZPGs2ca1Zqjo8OuZ5mKPMKhkBFCvOtELPUCrOYT4D2/iWkaX4LV+rxY/6uk3ZNM24YDUnaHs0YdMSxzg5jL/drjscTRCHX7os+avoAwgtPY6Ii04MUhouKFgwENnF6Nx+NnxpKxzWC17glr/V/gpmKp3DGBgP9vumFiWVz7Ht58OV7s5AtNT6BHG+gZNOEBr87om6GuNrCqY96MwUF15oxBbbWZg9qsmYP67NUGvB9tzqwBbc7sQW312TO0NebM1PGjrTF7tbKfxeOxI3JIV40wpyj9OadYJ52RHuuYs5chXqPwdymnJbBH+n5j8DXBS+w/05nUIyWuqeXxUE5xeA4JkEAxAoHcspn+nKUOy6a0pW5lLXVErJJz6v19/VVZ6kGEkRXpwGIXy7ZcLDHDkKOx61Qt1d870fsd3rU1eb9X2it6YJmGQ+HxKSqEv8bqHvO3Yg5Z1AHLv8BCRTCbhh0q5kPFkKzIT3hgt+QRERZ8cKUFr5sY7DWMI1F2sQOcC4vvFQzTN8wnoac3a6lHwr1V73Y3FdhAyC+932fMmNEQ58RKGzUcCU6YU/eZ2dUmxQ702Fl4yZL+GBgq206c4zNKz63jBVZa+KZhHVSqfD09oX3ks6GflnopVs34vuy3w2YUhnk0lkB2lq/Kw7uyyhTGEEbWZ1kqLPbzsW79chHMAmFSr4AVt/pkJSocWaiy5FVfNgTLdGR0RG5NGsJ8oupqacyz/9LJpMU8Jazn2LYQeLntaYMO4ZzlDXebDcqj5mSHhQU/ttKCNxRTzMOeBV+K3eBYF4fFt65pGQtrzmi6EijLtm1i4QruwanC4mZSznvor5eJ0mFq5HviU6zknKq0umHvAl+STWGlizjvcivfqY7xiHs1PF5K5cHvyydAUS+fVeecWWy8bpLarRpYokpVR/rxZDawS9pxjsSyrVexRGpGwOebPCzq+BK88QJXn3mNrYeNV9xkysnAVNex9OhP2LL0GJFkKpU8AM+ynWpMftLL5QIo8SDGsqdG5VHvdBMp7M5n+TXEqLkHDnNyLheR8j6LVQRfqndeufRybBqFqFHpVkej8CYodTvDMVV61WNI/SsBX+hDsdTolI54Pn92N7ZUwrkEwQaH0Zbl3nflnlddxXlVWQQo6mVh6oyTVvF+L29Wve6VT6Wc5aPRsW/AuUqBJby7z+cXnt6K3544jIj9o+VDopUeqSknJeeUsXHNGZjv/pf43bbs79Qdkpdgg+WqUeVGeF4pHOmUcwXC9N4hfvfZ9hGNyG98RCfHKhLMOlg24GilrjhevZKFSqefhhPjvUNDQ2ZGycgXK1svvr0ulq6tq7rufmIkCjsuXi7ORVtOnUU9l6c0oNG6LUmKehe1eC27V60cYqvPGBucqB5OuenjsvjdEwzs/xzL7bDmNYkXy2Slw1xrNJapZzeBwRDzReIT88e7Y2zTi/7WGoVsoVKknayzFkZ9drBt/1qNLlqj+kuj0q2UxyqW+hQJhALZ2BSxRPw8Kea29T0It55IR4ta61iu9zUEYxJx42/JuOkXyinb+Mwcxb0cXA0/h6LecMStk8G4pb7SZC9t0RSeUfqKsiuMHcFOCYRDN8FzWgn4fQtN2zeYf7GbCzHueR8L9S878QaemEpnN4FJpZ2/w+FPgUd8P0rWCLHCmHstYQAbCKGCpFMZ5z5YihnEkxdX1d/hb3w0o1Hdo1HpVgCx2Km5e9Fxiqwdz50/Gs1uvIIX0FsRD/71oaEV68BaF06viAc/cVgdcfL82Idd7vqHPRP+UGPpePk0EaCoTxP46cgW4pgdzl75KZ3ApjrGNXzVX0pdOuX34ZwFkUgmvosH/vvDw0Ozsewmu2FE7sDwu/zN9T5LTR7WVKIqLnaV12HRRMWVmK9s8LKtOr5NVVHVWi5BfBaxR+d/c2nMrCWtcq6tu0U9runT2wFXn1VDTPuMO5ZwUnJu3bJMuXGQVuAw56ru5+AgtzYiyInIimXHjK/HxkvltCvPKY8ARb08Th1x1kpxVOQyrIybkYI05VEwpFYvaRnJWRCw1t8di8cOFDHNY2NjX8CSsSNFeWzdh6m98ZeQrLi3iKW+kpebyLhuMvuAVH2y3LZdL0QyG0x71DW9Us3diO8Rb028POb6mms3Ig+vgzQsbdH/ptlgrzX/VDK1QOyJDn+QfTAEv1EqHc9YGnYIzB3wEZEOcnAbuSCWiKbKZZm333y5l/C8BhKgqDcQbqsljXCech4N4VHniE8IkgiROuXhvYUjFmb2vMLIF6USKPF9wIfANCnnNs3Q5R7hcKY6E5tlfCqRjgsNzy3nyunaND9UV6mKq4Qh5v4sU3dEfGKpXquVssYWqv3ydDpjoe/15TiVfpGsMctObYCaRyAy7mt4R7xGTHfhVVHs9Cbu59w9pm2MzZd2x5r2RDpd2Za+GKWqccFrjQ3OyycQoKh3SYfQNEtNZ5KuoWkzsR+3nP/Fw/atUtX3blcR47oBmq5E42NZhx3X/TU25nhYOOmEw6GrMawdwdxfbnog+8yoxdGvVD2r/H4DzKfb4sUHL0qvVZnG1JflHpftbK9DJGZgTlfGI4Aw/bfenJrFJs+3o95VKCu93CzUSseSKt5eEKVQxINXECviO7Dawxhyl/eYadnfEi8NmPK6OpmKY5e+8g9P07mvevnMGnkmRb2RdFsobdyvubZ2N8Obeh/eyF9CMAq5gcRUx0pLfVxd6j4cHApE1GQimY7Got/EnumJ5cuXz8EysQsTqWRW8HPDBGLLylLl9b43VGOg3HMrPy8bEAYvOtuKByGW5r2AIpZ8Qao8n/qsNCiRr7SgG3OITU+kv8FnRbAhcFqBBny8MXmJjBqWckskPG6p17DMETEW7kHo3qdWrFgxCF7/k3LEyJKxGrbokZY7ht4n+LWUU3E8R2iplwOqSedQ1JsEusZsxE1T0yPLa2hsBH2wKIurqHfHYmNyPrisI2cONcIqGo0OY3vIkJaMJ17B+vUDRHmwp/eXA37/D8TvYlMsWeYyxx9Ny/cb02e+jEs2ydZt/KFTVlVLn+SmwVO3bd9B2Qehc1MmnS57DrJ0+k06Q1W/jxGR15Hb9rkc6/w8cKT8wM9AhDUVc9I3Ypc7OU3R2GPqiGnV513rrHb1Oef6v0wgM/5uW115MFKXjQevGzLCHML67jU6OjIjGAw9Div9oUpLOT763oiHQ6WF4fmN32mKjGsmELJ89s1YX/qrbEpZ66eSQ9d8etpNpm3D3BGBX/YXTmmOk5bDcKWOlaZxzhO9bFu5VMoTv49GRzPYllV1kqmrTds6Sz7EFOWswRkDG/iDfjkPC5eAkrmbqtWPXTG/jQ1FeiEmD+AybJ0qrvOcAiorV5GzPeH7IfL4KPKIIiBNWSxrzrm+CVgmXvDwgA8j0IjwdBZx+MXIyCq7sFWXrSHTgQvGVxBOdyfs8odgJumGLJNapVNUfIdMXUMv/eoktDp6xa5avHSpLMrKpanVpY1NXq7B0PsKLDHcbs7qa2wWDPnly2ksnpQhj20rWBFBjOa1qNNLdXza/ao6v5m3O47WKz92A5sHC3YPiPCvMN67H+xCGNnZ4CflHIYR0NOZeLrHH+izg/754oGAUKeXJuLRp8q5fnh0WcEzs6SulpNs0XPgqCMTT2cyx4Uj4cfETl8o75XBcGhNeUEZTnopN7ksFovvIYZ6MeTbD49esQHNV8TCOJlC1YeJa+ULlUhnV8OyThVJwaP4ZHw0ZH918fweL24NJZ+kykkI+v9itcFryWQyCF63gY7Y4Eeswa9pZEhTxE5yThqJbGZapnzh0XTjIgTOr2ozoJJNtlJtG9I5x2d96t8GJatW7AQ4uGbFvfzZqAnJwGnxA0Qdvlr8MRGPXTE2PPopiPyyTNr5q/xbcvJ170UL7I3i1XJ7VUWCF5FAGxLQdH2G7fc9Ke5hPHhd7FGd9VrNHT7Dt8qjRtVN7IBpjr+w9fhD/Qg8IbZPdLEm/G3LsiveMjQYDIgdsFxsKfmPpmDUtY1snx0XeWLHqMXyMxS+uYK8N7Z9PjG07MJKdDHMvADjUhM2j8HGI1M+pg1w1PWJIyN4r/gqLFsxcuDi85YKylPNqao/4BcOeGJjl82qSaCMa1a3bPsJqRH4gQjfiGfzh8u4bspTdEX/HPgsyfZb/791w2rYbnZ4Afy37B/BsAyqEgz01tVY8QUsuUsbdjdsif3U7YAtngEu6l3J/TChvbBWfXP0KXlvyL5s2mdW2+ZrzFntCyKN1VZbrXH+EtUWjteRQEsS0NU1ET9bWIPyJrR8vvOxhWlZjmC2Ye8GIRdOXELQR03TwnB05Qf2F5dbrw4ODJTaW7nyxCe7QlXF/L8QZPngQVCMWytJHIz6MaT/F0+w8HIQ0y3rZEzSr11JOtlzjY9j+9BrxYNQlsmyboNB2/DQsPBS9rZe3bTyMpd3BSYmAtjnXoS8lXWDE2VaN4y5EPePlJfCyrNU1dzANH2XeG2GF6t/a7rd0IAz6NciBj/8MoK7iZJA1OtqU1t+86Mi/Ugk8m6lPBpxPvxFvi7Kgy1tb6ol/YH+fvkyJI0FRa860t/qsynqtbRDva8d3yu63gkzvfoQ8Fs+NZaMv5lyktuEI5HrRoaHd8ASoUPwIPuGcHhBAJmbM+nMs5huXpzB+Jl4puFnfV3VtjIs8yAMrW6XGElgmVj4pVg8/nlsHfpiNSVDPllpM83m9RnXvRjOaDsnEvGvibwhFGVPO4jzsc3rsqgzti+2/fwi9oU+FdGy1sWfj0M6x1n+wINYZnU9lqI9BX4vYURzGRjG8G9UVAtAFeZoqraupqubI3TmF8FxK5wvPLgV7Hr1i1QyeZLIohqWlVyzcr6ycWObaNooVh98G4MSV/nswBlYVvgx5Hs4HKkOhxX/L8dJ/Rl96wnweQHnCmt1FJxc+C+KOKOzce468HD/BDjti7756VQqLuLhK9jC8xxsbPeTTDoZq6TOlZ6r6pq0zPFGkrPQ69ssmZw/Buo2y/b5b9GRH4bCxDpGTIWJCWVQkFGCJnuXGA/2iyJ6v3tj6ML90xUv6xauX4o9EQ4di48tn4pBbp8jsZVqTSMS6NPnIJ/L8KJ/D1bEPF0p9/Hz0fjy2YCQkFWnwQtJoFsJ2H7rmxBob0hWWlbCesScmIv9j8etWs+ihKX3rmaYh+sYX6uFWcAyhSOVOzAw2DxLHRnC0osMDAz8R+Td1z9QkaWeX18R1dqwjS8EQsFbhWXicctqQXY0QPDLZ5h/DqzXFapm/F7R1Sqs/OrJe8PvSOHj1adS/pWGpWmGpe+OfK9FnafkhOF1+X0+p0hPT0I3rfM0y9y4/FxrOxPb+D4q29Cyd6ktpeJXwzIW7OV95tW3np/QZpkuhvcdvy8wu1Qd8LIuLXV/MHhjqXOn+j4Y8IWR54hu+favJZ3VZ8+Sw++zZ88R04Q8pplAXYepprkuXZO9L2QgQpe2u6Zou+ENf1OskV5P1/QBEVYV2yUux37lr8CqeMJx3bvwJLpdSTljtcLpDQf6ME2/NcK3vv/u4iVP1JpeJddHeiNrwmr8GCzDN5YsWfxMJdcWO1cP6Gvqrr6jrupb44G6EcyudfDZj4d2UJhSYDcEhm9jdOK/WKr2VMrN/B3S9Td48I3WmncV128FAzCI/MXLlPAxaNph+LVZmqt/BnzASd8YfD6MvtaLJUxhYZdiUGMErN6DFf86ViY87biZf8CqvR/9bUpLs94V8AXtTVGmQSw0/HcsFl1R7/SDYR/6RWZrFy6E8BxPYyczYICRLG1zYaILTzHx/5WPUyH/Ex3ZVlroonzSTs+dI34Vlj/u4YTmav8aHRmack8G02fPxJTJJzBO9DacaJ+rpb7BcOAj6ZT7RhxLFKpN58PrfmhmMpnaGo+fd958+63Hqk2H19WHAEW9PhynNRXTp5nwGLezQWAVB/9r6sN/Witfh8xNn44VAuDnukbOoTgFhlU/5OpQpJZMQrc0FeLthwjJKRhomeM6bsPDvrYkDBaKBEiABEig/QhgpQBffNuv2VhiEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiABEiCBrifwm9+eoH7/iB9Guh4EAZAACXQkAbUja8VKkUARAhfPv1hLJFPKW2+9df4rr7w6vGTxBz++6+47M4RFAiRAAp1CQOuUirAeJFCKgN/v+1ZfT89hm2666VGa6n75pf+8uGyD9dbfr9R1/J4ESIAE2oUARb1dWorlrJmAaRp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IgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgARIgASaSeD/A0iFVO/GS94RAAAAAElFTkSuQmCC
EOFILE;
$pngPlugin = <<< EOFILE
iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAACXBIWXMAAAsSAAALEgHS3X78AAAABGdBTUEAALGOfPtRkwAAACBjSFJNAAB6JQAAgIMAAPn/AACA6QAAdTAAAOpgAAA6mAAAF2+SX8VGAAABmklEQVR42mL4//8/AyUYIIDAxK5du1BwXEb3/9D4FjBOzZ/wH10ehkF6AQIIw4B1G7b+D09o/h+X3gXG4YmteA0ACCCsLghPbPkfm9b5PzK5439Sdg9eAwACCEyANMBwaFwTGIMMAOEQIBuGA6Mb/qMbABBAEAOQnIyMo1M74Tgiqf2/b3gVhgEAAQQmQuKa/8ekdYMxyLCgmEYMHJXc9t87FNMAgACCGgBxIkgzyDaQU5FxQGQN2AUBUXX/vULKwdgjsOQ/SC9AAKEEYlB03f+oFJABdSjYP6L6P0guIqkVjt0DisEGAAQQigEgG0AhHxBVi4L9wqvBBiEHtqs/xACAAAIbEBBd/x+Eg2ObwH4FORmGfYCaQRikCUS7B5YBNReBMUgvQABBDADaAtIIwsEx9f/Dk9pQsH9kHTh8XANKMAIRIIDAhF9ELTiQQH4FaQAZCAsskPNhyRpkK7oBAAEEMSC8GsVGkEaYIlBghcU3gbGzL6YBAAEEJnzCgP6EYs/gcjCGKQI5G4Z9QiswDAAIIAZKszNAgAEAHgFgGSNMTwgAAAAASUVORK5CYII=
EOFILE;
$pngWrench = <<< EOFILE
iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAA3NCSVQICAjb4U/gAAABO1BMVEXu7u7n5+fk5OTi4uLg4ODd3d3X19fV1dXU1NTS0tLPz8+7z+/MzMy6zu65ze65zu7Kysq3zO62zO3IyMjHx8e1yOiyyO2yyOzFxcXExMSyxue0xuexxefDw8OtxeuwxOXCwsLBwcGuxOWsw+q/v7+qweqqwuqrwuq+vr6nv+qmv+m7u7ukvumkvemivOi5ubm4uLicuOebuOeat+e0tLSYtuabtuaatuaXteaZteaatN6Xs+aVs+WTsuaTsuWRsOSrq6uLreKoqKinp6elpaWLqNijo6OFpt2CpNyAo92BotyAo9+dnZ18oNqbm5t4nt57nth7ntp4nt15ndp3nd6ZmZmYmJhym956mtJzm96WlpaVlZVwmNyTk5Nvl9lultuSkpKNjY2Li4uKioqIiIiHh4eGhoZQgtVKfNFdha6iAAAAaXRSTlMA//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////914ivwAAAACXBIWXMAAAsSAAALEgHS3X78AAAAH3RFWHRTb2Z0d2FyZQBNYWNyb21lZGlhIEZpcmV3b3JrcyA4tWjSeAAAAKFJREFUGJVjYIABASc/PwYkIODDxBCNLODEzGiQgCwQxsTlzJCYmAgXiGKVdHFxYEuB8dkTOIS1tRUVocaIWiWI8IiIKKikaoD50kYWrpwmKSkpsRC+lBk3t2NEMgtMu4wpr5aeuHcAjC9vzadjYyjn7w7lK9kK6tqZK4d4wBQECenZW6pHesEdFC9mbK0W7otwsqenqmpMILIn4tIzgpG4ADUpGMOpkOiuAAAAAElFTkSuQmCC
EOFILE;
$favicon = $gifLogo;


//affichage du phpinfo
if (isset($_GET['phpinfo']))
{
	phpinfo();
	exit();
}


//affichage des images
if (isset($_GET['img']))
{
    switch ($_GET['img'])
    {
        case 'pngFolder' :
        header("Content-type: image/png");
        echo base64_decode($pngFolder);
        exit();
        
        case 'pngFolderGo' :
        header("Content-type: image/png");
        echo base64_decode($pngFolderGo);
        exit();
        
        case 'gifLogo' :
        header("Content-type: image/gif");
        echo base64_decode($gifLogo);
        exit();
        
        case 'pngPlugin' :
        header("Content-type: image/png");
        echo base64_decode($pngPlugin);
        exit();
        
        case 'pngWrench' :
        header("Content-type: image/png");
        echo base64_decode($pngWrench);
        exit();
        
        case 'favicon' :
        header("Content-type: image/x-icon");
        echo base64_decode($favicon);
        exit();
    }
}



// D?nition de la langue et des textes 

if (isset ($_GET['lang']))
{
	$langue = $_GET['lang'];
}
elseif (isset ($_SERVER['HTTP_ACCEPT_LANGUAGE']) AND preg_match("/^fr/", $_SERVER['HTTP_ACCEPT_LANGUAGE']))
{
	$langue = 'fr';
}
else
{
	$langue = 'pt-br';
}

//initialisation
$aliasContents = '';

// recuperation des alias
if (is_dir($aliasDir))
{
    $handle=opendir($aliasDir);
    while ($file = readdir($handle)) 
    {
	    if (is_file($aliasDir.$file) && strstr($file, '.conf'))
	    {		
		    $msg = '';
		    $aliasContents .= '<li><a href="'.str_replace('.conf','',$file).'/">'.str_replace('.conf','',$file).'</a></li>';
	    }
    }
    closedir($handle);
}
if (!isset($aliasContents))
	$aliasContents = $langues[$langue]['txtNoAlias'];


// recuperation des projets
$handle=opendir(".");
$projectContents = '';
while ($file = readdir($handle)) 
{
	if (is_dir($file) && !in_array($file,$projectsListIgnore)) 
	{		
		$projectContents .= '<li><a href="'.$file.'">'.$file.'</a></li>';
	}
}
closedir($handle);
if (!isset($projectContents))
	$projectContents = $langues[$langue]['txtNoProjet'];


//initialisation
$phpExtContents = '';

// recuperation des extensions PHP
$loaded_extensions = get_loaded_extensions();
foreach ($loaded_extensions as $extension)
	$phpExtContents .= "<li>${extension}</li>";




$pageContents = <<< EOPAGE
<?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html lang="pt-br" xml:lang="pt-br">
<head>
	<title>{$langues[$langue]['titreHtml']}</title>
	<meta http-equiv="Content-Type" content="txt/html; charset=utf-8" />

	<style type="text/css">
* {
	margin: 0;
	padding: 0;
}

html {
	background: #ddd;
}
body {
	margin: 1em 10%;
	padding: 1em 3em;
	font: 80%/1.4 tahoma, arial, helvetica, lucida sans, sans-serif;
	border: 1px solid #999;
	background: #eee;
	position: relative;
}
#head {
	margin-bottom: 1.8em;
	margin-top: 1.8em;
	padding-bottom: 0em;
	border-bottom: 1px solid #999;
	letter-spacing: -500em;
	text-indent: -500em;
	height: 125px;
	background: url(index.php?img=gifLogo) 0 0 no-repeat;
	background-size: 15% 100%;
}
.utility {
	position: absolute;
	right: 4em;
	top: 145px;
	font-size: 0.85em;
}
.utility li {
	display: inline;
}

h2 {
	margin: 0.8em 0 0 0;
}

ul {
	list-style: none;
	margin: 0;
	padding: 0;
}
#head ul li, dl ul li, #foot li {
	list-style: none;
	display: inline;
	margin: 0;
	padding: 0 0.2em;
}
ul.aliases, ul.projects, ul.tools {
	list-style: none;
	line-height: 24px;
}
ul.aliases a, ul.projects a, ul.tools a {
	padding-left: 22px;
	background: url(index.php?img=pngFolder) 0 100% no-repeat;
}
ul.tools a {
	background: url(index.php?img=pngWrench) 0 100% no-repeat;
}
ul.aliases a {
	background: url(index.php?img=pngFolderGo) 0 100% no-repeat;
}
dl {
	margin: 0;
	padding: 0;
}
dt {
	font-weight: bold;
	text-align: right;
	width: 11em;
	clear: both;
}
dd {
	margin: -1.35em 0 0 12em;
	padding-bottom: 0.4em;
	overflow: auto;
}
dd ul li {
	float: left;
	display: block;
	width: 16.5%;
	margin: 0;
	padding: 0 0 0 20px;
	background: url(index.php?img=pngPlugin) 2px 50% no-repeat;
	line-height: 1.6;
}
a {
	color: #024378;
	font-weight: bold;
	text-decoration: none;
}
a:hover {
	color: #04569A;
	text-decoration: underline;
}
#foot {
	text-align: center;
	margin-top: 1.8em;
	border-top: 1px solid #999;
	padding-top: 1em;
	font-size: 0.85em;
}
</style>
    
	<link rel="shortcut icon" href="index.php?img=favicon" type="image/ico" />
</head>

<body>
	<div id="head">
		<h1><abbr title="Windows">W</abbr><abbr title="Apache">A</abbr><abbr title="MySQL">M</abbr><abbr title="PHP">P</abbr></h1>
		<ul>
			<li>PHP 5</li>
			<li>Apache 2</li>
			<li>MySQL 5</li>
		</ul>
	</div>

	<ul class="utility">
		<li>Versão ${wampserverVersion}</li>
		<li><a href="?lang={$langues[$langue]['autreLangueLien']}">{$langues[$langue]['autreLangue']}</a></li>
	</ul>

	<h2> {$langues[$langue]['titreConf']} </h2>

	<dl class="content">
		<dt>{$langues[$langue]['versa']}</dt>
		<dd>${apacheVersion} &nbsp;</dd>
		<dt>{$langues[$langue]['versp']}</dt>
		<dd>${phpVersion} &nbsp;</dd>
		<dt>{$langues[$langue]['phpExt']}</dt> 
		<dd>
			<ul>
			${phpExtContents}
			</ul>
		</dd>
		<dt>{$langues[$langue]['versm']}</dt>
		<dd>${mysqlVersion} &nbsp;</dd>
		<dt>{$langues[$langue]['versma']}</dt>
		<dd>${mariadbVersion} &nbsp;</dd>
	</dl>
	<h2>{$langues[$langue]['titrePage']}</h2>
	<ul class="tools">
		<li><a href="?phpinfo=1">phpinfo()</a></li>
		<li><a href="pma/">phpmyadmin</a></li>
	</ul>
	<h2>{$langues[$langue]['txtProjet']}</h2>
	<ul class="projects">
	$projectContents
	</ul>
	<h2>{$langues[$langue]['txtAlias']}</h2>
	<ul class="aliases">
	${aliasContents}			
	</ul>
	<ul id="foot">
		
	</ul>
</body>
</html>
EOPAGE;
// <li><a href="http://www.wampserver.com">WampServer</a></li> - 
echo $pageContents;
?>
