<?php

namespace App\Tests;

use App\Entity\Animateur;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class AnimateurTest extends TestCase
{
    /**
     * @dataProvider getValidationTestCases
     */
    public function testAnimateurValidation($nom, $prenom, $email, $password, $expected): void
    {
        //Arrange
        $animateur = Animateur::build($nom, $prenom, $email, $password);
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        // Act
        $result = $validator->validate($animateur);

        // Assert
        $this->assertEquals($expected, count($result) == 0);
    }
    /**
     * fournisseur de données pour les métodes de test
     */
    public function getValidationTestCases()
    {
        return [
            'Lorsque les données sont correctes' => ['benabbou', 'mehdi', 'mehdibenabbou@gmail.com', 'Mehdi85@', true],
            'Échec lorsque le nom est vide' => ['', 'mehdi', 'mehdibenabbou@gmail.com', 'Mehdi85@', false],
            'Échec lorsque le prenom est vide' => ['benabbou', '', 'mehdibenabbou@gmail.com', 'Mehdi85@', false],
            'Échec lorsque l\'e-mail n\'est pas valide' => ['benabbou', 'mehdi', 'mehdibenabbougmail.com', 'Mehdi85@', false],
            'Échec lorsque le mot de passe est manquant' => ['benabbou', 'mehdi', 'mehdibenabbou@gmail.com', '', false],
            'Échec lorsque le mot de passe contient moins de 6 caractères' => ['benabbou', 'mehdi', 'mehdibenabbou@gmail.com', 'Mh85@', false],
            'Échec lorsque le mot de passe ne contient pas de caractère spécial' => ['benabbou', 'mehdi', 'mehdibenabbou@gmail.com', 'Mehdi85', false],
            'Échec lorsque le mot de passe ne contient pas de caractère majuscule' => ['benabbou', 'mehdi', 'mehdibenabbou@gmail.com', 'mehdi85@', false],
            'Échec lorsque le mot de passe ne contient pas de caractère minuscule' => ['benabbou', 'mehdi', 'mehdibenabbou@gmail.com', 'MEHDI85@', false],
            'Échec lorsque le mot de passe ne contient pas de chiffre' => ['benabbou', 'mehdi', 'mehdibenabbou@gmail.com', 'Mehdii@', false],
        ];
    }
}
