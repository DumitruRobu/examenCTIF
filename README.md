Salut, daca citesti asta, inseamna ca intr-adevar te-ai interesat de candidatura mea. Apreciez acest lucru.
Acest proiect reprezinta o platforma full functionala de tip Restful-API cu autorizare tip JWT token integrata, care respecta pasii din taskul primit de mine din partea IP CTIF.
Platforma a fost scrisa cu grija si multa staruinta de mine, timp de 2 luni de munca intensiva (scriere cod + debugging + final testing) precedata de 5 luni de studiu al materialelor, cerintelor si tehnologiilor cerute. Platforma e adaptabila versiunii mobile si PC.

Taskul a sunat in felul urmator: Laravel & Vue Task. Tehnologii: PHP 8.1^, Laravel 9.0^, MySQL 8.0^, Vue 3, Tailwind (opțional)
Sarcina principală:
1. Creați o interfață web utilizând Vue 3, care să imite pagina expusă pe site-ul Ministerului de Finanțe. (https://mf.gov.md/ro/iban)
Interfața trebuie să fie responsive, modernă și să respecte UX/UI.
2. Descărcați în format CSV lista codurilor IBAN de pe site-ul Ministerului de Finanțe și
actualizați datele pentru anul curent.
3. Creați baza de date (migrații) conform structurii din fișierul CSV, folosind Eloquent
ORM.
4. Elaborați API în Laravel pentru a permite filtrarea datelor din baza de date după criterii
precum anul, codul eco, raionul, localitatea.
Utilizați Vue.js pentru a crea o interfață interactivă care comunică cu aceste APIuri.
5. Creați tabelele users , roles , user_roles în baza de date folosind migrările Laravel.
6. Definește rolurile în tabelul roles : admin , operator , operator_raion .
7. Implementați un sistem de autentificare securizat, cu tokenuri JWT (JSON Web
Tokens).
Asigurați autentificarea și autorizarea pe baza rolurilor pentru acces la diferite
secțiuni ale aplicației.
8. Creați utilizatori pentru diferite roluri cu acces diferit bazat pe roluri.
operator_raion: Acces limitat la datele specificului raion.
operator: Acces nelimitat la date.
9. Dezvoltați un panou de administrare pentru gestionarea utilizatorilor (creare, editare,
ștergere).
10. Implementați funcționalitatea pentru ca administratorul să poată atribui roluri
utilizatorilor înregistrați.
11. Dezvoltați funcționalitatea pentru gestionarea codurilor IBAN prin intermediul API
Implementați validarea formatului IBAN și CRUD pentru codurile IBAN.
Introducea strict a 24 de caractere, daca se regăsesc litere sa fie UPERCASE.
Primele 2 litere sa se înceapă numai cu “MD”
Ultimele 14 caractere sa fie cifre
Codul trebuie să fie unic
12. Documentați și plasați codul sursă pe Git, incluzând seeder-e și un readme pentru
instrucțiuni de instalare.
Note suplimentare:
Toate apelurile între frontend (Vue.js) și backend (Laravel) trebuie să se realizeze prin
API-uri RESTful.
