/// <reference types="cypress" />

describe('Probar la autenticacion', () => {

    it('Prueba la autenticacion en el /login', () => {

        cy.visit('/login');

        cy.get('[data-cy="heading-login"]').should('exist');

        cy.get('[data-cy="heading-login"]').should('have.text', 'Iniciar Sesión');

        cy.get('[data-cy="formulario-login"]').submit();

        cy.get('[data-cy="alerta-login"]').should('exist');

        cy.get('[data-cy="alerta-login"]').eq(0).should('have.text', 'El email es obligatorio');

        cy.get('[data-cy="alerta-login"]').eq(0).should('have.class', 'alerta').and('have.class', 'error');

        cy.get('[data-cy="alerta-login"]').eq(1).should('have.text', 'El password es obligatorio');

        cy.get('[data-cy="alerta-login"]').eq(1).should('have.class', 'alerta').and('have.class', 'error');
    });
});