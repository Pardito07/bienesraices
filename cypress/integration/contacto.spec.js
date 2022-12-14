/// <reference types="cypress" /> 

describe('Prueba el formulario de contacto', () => {

    it('Prueba la pagina de contacto y el envio de emails', () => {
        
        cy.visit('/contacto');

        cy.get('[data-cy="heading-contacto"]').should('exist');

        cy.get('[data-cy="heading-contacto"]').invoke('text').should('equal', 'Contacto');

        cy.get('[data-cy="heading-contacto"]').invoke('text').should('not.equal', 'Llene el Formulario de Contacto');

        cy.get('[data-cy="heading-formulario"]').should('exist');

        cy.get('[data-cy="heading-formulario"]').invoke('text').should('equal', 'Llene el Formulario de Contacto');

        cy.get('[data-cy="heading-formulario"]').invoke('text').should('not.equal', 'Contacto');

        cy.get('[data-cy="formulario-contacto"]').should('exist');
    });

    it('Llena los campos del formulario', () => {

        cy.get('[data-cy="input-nombre"]').type('Diego Pardo');

        cy.get('[data-cy="input-mensaje"]').type('Estoy interesado en una propiedad, podría brindarme más información');

        cy.get('[data-cy="input-opciones"]').select('Compra');

        cy.get('[data-cy="input-precio"]').type('120000');

        cy.get('[data-cy="input-contacto"]').eq(1).check();

        cy.get('[data-cy="input-contacto"]').eq(0).check();

        cy.get('[data-cy="input-fecha"]').type('2022-08-01');

        cy.get('[data-cy="input-hora"]').type('10:30');

        cy.get('[data-cy="formulario-contacto"]').submit();

        cy.get('[data-cy="mensaje-contacto"]').should('exist');

        cy.get('[data-cy="mensaje-contacto"]').invoke('text').should('equal', 'Mensaje Enviado');

        cy.get('[data-cy="mensaje-contacto"]').should('have.class', 'alerta').and('have.class', 'exito');
    }); 
});