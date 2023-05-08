# Verbrauchsdaten
Das Modul zeigt die Verbrauchsdaten einer geloggten Variable an.

### Inhaltsverzeichnis

- [Verbrauchsdaten](#verbrauchsdaten)
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

* Das Modul zeigt die Verbrauchsdaten einer geloggten Variable an.

### 2. Voraussetzungen

- IP-Symcon ab Version 6.0

### 3. Software-Installation

* Über den Module Store das 'Verbrauchsdaten'-Modul installieren.

### 4. Einrichten der Instanzen in IP-Symcon

 Unter 'Instanz hinzufügen' kann das 'Verbrauchsdaten'-Modul mithilfe des Schnellfilters gefunden werden.  
	- Weitere Informationen zum Hinzufügen von Instanzen in der [Dokumentation der Instanzen](https://www.symcon.de/service/dokumentation/konzepte/instanzen/#Instanz_hinzufügen)

__Konfigurationsseite__:

Name     | Beschreibung
-------- | ------------------
Aktiv         | Schaltet die Instanz aktiv, bzw. deaktiviert diese.
Geloggte Variable | Die Variable, für welche die Verbrauchsdaten angezeigt werden sollen. Die Variable muss als Zählervariable geleoggt sein.
Heute | Verbrauchsdaten für Heute
Gestern | Verbrauchsdaten für Gestern
Aktuelle Woche | Verbrauchsdaten für die aktuelle Woche
Letzte Woche | Verbrauchsdaten für die letzte Woche
Aktueller Monat | Verbrauchsdaten für den aktuellen Monat
Letzter Monat | Verbrauchsdaten für den letzten Monat
Aktuelles Jahr | Verbrauchsdaten für das aktuelle Jahr
letzte Jahr | Verbrauchsdaten für das letzte Jahr
Aktualisierungsintervall | Intervall in Sekunden, wie oft die Werte aktualisiert werden sollen

### 5. Statusvariablen und Profile

Die Statusvariablen/Kategorien werden automatisch angelegt. Das Löschen einzelner kann zu Fehlfunktionen führen.

#### Statusvariablen

Name   | Typ     | Beschreibung
------ | ------- | ------------
Heute | Float |Verbrauchsdaten für Heute
Gestern | Float |Verbrauchsdaten für Gestern
Aktuelle Woche | Float | Verbrauchsdaten für die aktuelle Woche
Letzte Woche | Float | Verbrauchsdaten für die letzte Woche
Aktueller Monat | Float | Verbrauchsdaten für den aktuellen Monat
Letzter Monat | Float | Verbrauchsdaten für den letzten Monat
Aktuelles Jahr | Float | Verbrauchsdaten für das aktuelle Jahr
letzte Jahr | Float | Verbrauchsdaten für das letzte Jahr
Aktualisierungsintervall | Float | Intervall in Sekunden, wie oft die Werte aktualisiert werden sollen

### 6. WebFront

Das Webfront zeigt dei Verbrauchsdaten an.

### 7. PHP-Befehlsreferenz

`VD_Update(integer $InstanzID);`
Die Funktion aktualisiert die Werte.

Beispiel:
`VD_Update(12345);`