# Misja Gynvaeal 008 - Rozwiązanie zadania

>MISJA 008            goo.gl/gg4QcA                  DIFFICULTY: █████████░ [9/10]
> ┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅┅
> 
> Otrzymaliśmy dość nietypową prośbę o pomoc od lokalnego Instytutu Archeologii.
> Okazało się, iż podczas prac remontowych studni w pobliskim zamku odkryto
> niewielki tunel. Poproszono nas abyśmy skorzystali z naszego autonomicznego
> drona wyposażonego w LIDAR (laserowy skaner odległości zamontowany na obracającej
> się platformie) do stworzenia mapy tunelu.
> 
> Przed chwilą dotarliśmy na miejsce i opuściliśmy drona do studni. Interfejs I/O
> drona znajduje się pod poniższym adresem:
> 
>   http://gynvael.coldwind.pl/misja008_drone_output/
> 
> Powodzenia!
> 
> --
> 
> Korzystając z powyższych danych stwórz mapę tunelu (i, jak zwykle, znajdź tajne
> hasło). Wszelkie dołączone do odpowiedzi animacje są bardzo mile widziane.
> 
> Odzyskaną wiadomość (oraz mapę) umieśc w komentarzu pod tym video :)
> Linki do kodu/wpisów na blogu/etc z opisem rozwiązania są również mile widziane!
> 
> HINT 1: Serwer może wolno odpowiadać a grota jest dość duża. Zachęcam więc do
> cache'owania danych na dysku (adresy skanów są stałe dla danej pozycji i nigdy
> nie ulegają zmianie).
> 
> HINT 2: Hasło będzie można odczytać z mapy po odnalezieniu i zeskanowaniu
> centralnej komnaty.
> 
> P.S. Rozwiązanie zadania przedstawie na początku kolejnego livestreama.

## Rozwiązanie
`php crawler.php` - Pobieranie wszystkich plików z danymi do zadania

`php solver.php` - Rysowanie mapy 