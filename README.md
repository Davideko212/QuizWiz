# QuizWiz
## Info
Eine Web-Applikation zur Beantwortung von diversen Trivia-Fragen im Quizformat

Das Frontend dieses Projektes wurde mit dem SvelteKit JavaScript framework und dem Skeleton UI toolkit gemacht. Als Backend wird eine MySQL-Datenbank mit PHP verwendet.

## Betriebsanleitung
### Benötigte Applikationen
<ul>
    <li>XAMPP (mit Apache & MySQL)
    <li>Web-Browser Ihrer Wahl
</ul>

### Benötigte Ordner/Dateien
<ul>
    <li>QuizWiz Ordner (enthält svelte & backend Ordner)
    <li>SQL-Skript zur Erstellung der Datenbank
    <li>httpd.conf Konfigurationsdatei (optional)
</ul>

### Installation
Laden Sie den QuizWiz Ordner herunter und platzieren Sie ihn in den `htdocs` Ordner unter XAMPP. Danach starten Sie Apache sowohl als auch den MySQL Server im XAMPP Controlpanel.

Im Abgabeordner findet sich auch ein SQL-Skript namens `quizDB.sql`. Dieses Skript führen Sie am besten zum Beispiel mit einem Programm wie DataGrip aus, um die für diese Applikation benötigte SQL-Datenbank bei Ihnen lokal aufzusetzen.

### Nutzung
Besuchen Sie im Web-Browser ihrer Wahl die Seite http://localhost/QuizWiz/svelte/build/. Bevor Sie mit ihrem ersten Quiz loslegen, können Sie sich anmelden/registrieren um später Zugriff auf diverse Statistiken zu erhalten.

**ACHTUNG:** falls Sie nicht unter der oben angegebenen URL auf QuizWiz zugreifen können, ersetzen Sie ihre derzeitige `httpd.conf` Datei mit der im Abgabeordner mitgelieferten Datei.

Sobald Sie bereit sind, mit ihrem ersten Quiz loszulegen, können Sie auf der Titelseite ihre gewünschten Quiz-Einstellungen treffen und zum Starten des Quiz auf den Button "Quiz starten" drücken.

Nachdem das Quiz gestartet worden ist, werden Sie auf eine andere Seite weitergeleitet, wo jeweils eine Frage des Quiz mit dessen Antwortmöglichkeiten angezeigt wird. Um zwischen den einzelnen Frage zu navigieren, nutzen Sie die zwei Buttons (jeweils "Zurück" und "Nächste") unter der Fragestellung. Bei der letzten Frage wird der "Nächste" Button durch "Auswerten" ersetzt. Mit diesem können Sie das Quiz beenden und eine Auswertung erhalten.

Auf der Auswertungsseite wird Ihnen ein Diagramm angezeigt, welches veranschaulicht, wie viele Fragen des Quiz Sie richtig, falsch oder unbeantwortet gelassen haben. Mit dem Button "Zurück zum Hauptmenü" können sie zur Titelseite zurückkehren, wo Sie ein weiteres Quiz starten können.

**ACHTUNG:** falls während der Nutzung von QuizWiz ein Fehler auftreten sollte, probieren Sie die Seite neu zu laden.

### Grundfeatures
Es wurden alle geforderten Grundfeatures in dieser Applikation implementiert, bis auf das Anzeigen der richtigen Antworten bei der Quiz-Auswertung. Bei jedem ordentlichen Quiz mit Wiederspielbarkeit werden bei der Auswertung die richtigen Antworten nicht angezeigt, einfach weil sonst der Nutzer sich die richtigen Antworten aufschreiben/merken könnte und direkt beim nächsten Versuch alles richtig haben kann. Das wollte ich nicht, und hab dies deswegen nicht implementiert.

### Erweiterungen
Es wurden folgende Erweiterungen implementiert:
<ul>
    <li>Das Quiz geht über mehrere Seiten
    <li>Zwischen den Seiten kann vor und zurück geblättert werden und die Antworten können geändert werden
    <li>Das Quiz kann vom User unterbrochen und zu einem späteren Zeitpunkt fortgesetzt werden (so lange der Browser-Cache nicht geleert wird)
    <li>Ein (zumindest meiner Meinung nach) ansehliches Äußeres
    <li>Aus einer Vielzahl von Fragen wird eine zufällige Anzahl von x Fragen verwendet
    <li>Die Fragen werden pro Durchlauf in einer anderen (zufälligen) Reihenfolge angeboten
    <li>Die Antwortmöglichkeiten werden für jeden Durchlauf in einer anderen (zufälligen) Reihenfolge angeboten
</ul>