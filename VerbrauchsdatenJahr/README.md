# VerbrauchsdatenJahr
Das Modul zeigt die Verbrauchsdaten für ein eingestelltes Jahr an.

### Inhaltsverzeichnis

- [VerbrauchsdatenJahr](#verbrauchsdatenjahr)
    - [Inhaltsverzeichnis](#inhaltsverzeichnis)
    - [1. Funktionsumfang](#1-funktionsumfang)
    - [2. Voraussetzungen](#2-voraussetzungen)
    - [3. Software-Installation](#3-software-installation)
    - [4. Einrichten der Instanzen in IP-Symcon](#4-einrichten-der-instanzen-in-ip-symcon)
    - [5. Statusvariablen und Profile](#5-statusvariablen-und-profile)
      - [Statusvariablen](#statusvariablen)
    - [6. WebFront](#6-webfront)
    - [7. PHP-Befehlsreferenz](#7-php-befehlsreferenz)

### 1. Funktionsumfang

* Das Modul zeigt die Verbrauchsdaten einer geloggten Variable für das vorgegebene Jahr an.

### 2. Voraussetzungen

- IP-Symcon ab Version 6.0

### 3. Software-Installation

* Über den Module Store das 'Verbrauchsdaten'-Modul installieren.

### 4. Einrichten der Instanzen in IP-Symcon

 Unter 'Instanz hinzufügen' kann das 'VerbrauchsdatenJahr'-Modul mithilfe des Schnellfilters gefunden werden.  
	- Weitere Informationen zum Hinzufügen von Instanzen in der [Dokumentation der Instanzen](https://www.symcon.de/service/dokumentation/konzepte/instanzen/#Instanz_hinzufügen)

__Konfigurationsseite__:

Name     | Beschreibung
-------- | ------------------
Aktiv         | Schaltet die Instanz aktiv, bzw. deaktiviert diese.
Geloggte Variable | Die Variable, für welche die Verbrauchsdaten angezeigt werden sollen. Die Variable muss als Zählervariable geleoggt sein.
Jahr | Jahr für welche die Daten angezeigt werden sollen


### 5. Statusvariablen und Profile

Die Statusvariablen/Kategorien werden automatisch angelegt. Das Löschen einzelner kann zu Fehlfunktionen führen.

#### Statusvariablen

Name   | Typ     | Beschreibung
------ | ------- | ------------
Januar | Float |Verbrauchsdaten für Januar
Februar | Float |Verbrauchsdaten für Februar
März | Float | Verbrauchsdaten für März
April | Float | Verbrauchsdaten für April
Mai | Float | Verbrauchsdaten für Mai
Juni | Float | Verbrauchsdaten für Juni
Juli | Float | Verbrauchsdaten für Juli
August | Float | Verbrauchsdaten für August
September | Float | Verbrauchsdaten für September
Oktober | Float | Verbrauchsdaten f+r Oktober
November | Float | Verbrauchsdaten für November
Dezember | Float | Verbrauchsdaten für Dezember

### 6. WebFront

Das Webfront zeigt dei Verbrauchsdaten an.

### 7. PHP-Befehlsreferenz

`VD_Update(integer $InstanzID);`
Die Funktion aktualisiert die Werte.

Beispiel:
`VD_Update(12345);`