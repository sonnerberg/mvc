### Kursmoment 2

<!-- Förklara kort de objektorienterade konstruktionerna arv, komposition, interface och trait och hur de används i PHP. -->

#### Arv

När en klass ärver från en annan klass så får den klass som ärver tillgång till medlemsvariabler och metoder från basklassen (basklassen är den klass som ärvs ifrån). Medlemsvariabler och metoder som är satta till "private" ärvs inte, men de som är "protected" eller "public" ärvs från basklassen.

#### Komposition

Komposition är när en klass använder sig av en annan klass. Ett exempel är en kortlek där det finns en klass som beskriver ett kort och en klass som innehåller kortleken. Här skapas korten från klassen som beskriver kort och används sedan i klassen som beskriver kortleken.

#### Interface

Ett Interface i PHP beskriver vilka metoder en klass måste implementera men beskriver inte hur dessa metoder skall implementeras utan detta lämnas till kodaren.

#### Trait

Ett trait i PHP implementerar metoder som klasser sedan kan använda sig av. Detta leder till att metoder kan implementeras på ett enda ställe och sedan kan klasser få implementationen av vissa metoder från ett trait.

<!-- Berätta om din implementation från uppgiften. Hur löste du uppgiften, är du nöjd/missnöjd, vilken förbättringspotential ser du i din koden och dina klasser? -->

Jag är inte helt nöjd med min kod för denna uppgiften. Jag tyckte att det var lite svårt och ville mest bara pricka av alla kraven, så jag har lämnat en del städning till senare kursmoment. Jag har en del kod i mina controllers som är likanande på flera ställen som borde kunna ändras om till att bara skrivas en enda gång.

<!-- Berätta hur det kändes att modellera ett kortspel med flödesdiagram och psuedokod. Var det något som du tror stödjer dig i din problemlösning och tankearbete för att strukturera koden kring en applikation? -->

Flödesdiagram och psuedokod hjälper absolut när man ska implementera saker i kod. Det är ett bra sätt att tänka igenom så mycket som möjligt innan koden skrivs och underlättar för att veta vad som behöver komma på plats för att få koden att göra som man vill.

<!-- Vilken är din TIL för detta kmom? -->

Min TIL för detta kursmomentet är att symfony är väldigt trevligt att jobba med. Jag ser fram emot att lära mig mer om symfony och i framtiden använda det för egna projekt.
