# QuizWiz
## Info
Eine Web-Applikation zur Beantwortung von diversen Trivia-Fragen im Quizformat

## Betriebsanleitung
### Benötigte Applikationen
<ul>
    <li>XAMPP (mit Apache & MySQL)
</ul>

### Benötigte Ordner/Dateien
<ul>
    <li>QuizWiz Ordner (enthält svelte & backend Ordner)
    <li>httpd.conf Konfigurationsdatei (optional)
</ul>

### Installation
Laden Sie den QuizWiz Ordner herunter und platzieren Sie ihn in den htdocs Ordner unter XAMPP. Danach starten Sie Apache sowohl als auch den MySQL Server im XAMPP Controlpanel.


### Nutzung
Besuchen Sie im Web-Browser ihrer Wahl die Seite http://localhost/QuizWiz/svelte/build/. Bevor Sie mit ihrem ersten Quiz loslegen, können Sie sich anmelden/registrieren um später Zugriff auf diverse Statistiken zu erhalten.

Sobald Sie bereit sind, mit ihrem ersten Quiz loszulegen, können Sie auf der Titelseite ihre gewünschten Quiz-Einstellungen treffen und zum Starten des Quiz auf den Button "Quiz starten" drücken.

Nachdem das Quiz gestartet worden ist, werden Sie auf eine andere Seite weitergeleitet, wo jeweils eine Frage des Quiz mit dessen Antwortmöglichkeiten angezeigt wird. Um zwischen den einzelnen Frage zu navigieren, nutzen Sie die zwei Buttons (jeweils "Zurück" und "Nächste") unter der Fragestellung. Bei der letzten Frage wird der "Nächste" Button durch "Auswerten" ersetzt. Mit diesem können Sie das Quiz beenden und eine Auswertung erhalten.

Auf der Auswertungsseite wird Ihnen ein Diagramm angezeigt, welches veranschaulicht, wie viele Fragen des Quiz Sie richtig, falsch oder unbeantwortet gelassen haben. Mit dem Button "Zurück zum Hauptmenü" können sie zur Titelseite zurückkehren, wo Sie ein weiteres Quiz starten können.

