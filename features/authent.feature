Feature: Authentification
In order to sign in an account
As a user
Test fonctionnel sur l'authentification d'un user
Scenario: test authentification I fill my username and password only
Given I am on the authentification page
And I authenticated as "fhollande" using "monpwd"
When I submit the form
Then I should see Accueil

Scenario: AjoutLivre
Given I am on the id Page and authenticated as "fhollande" using "monpwd"
And I am on the book page
And I completed the form with "L'outsider","Stephen King","Edition1","Chouette livre"
When I add the book
Then I should see the confirmation message