# Skill: Boas Práticas de Banco de Dados

## Diretrizes para Migrations e Models

1. **Integridade:** Use `constrained()->cascadeOnDelete()` em chaves estrangeiras.
2. **Soft Deletes:** Implemente `SoftDeletes` em agendamentos e serviços.
3. **Mass Assignment:** Defina explicitamente o `$fillable` nos Models. Não use `$guarded = []`.
4. **Tipagem:** Utilize tipagem de retorno em todos os métodos dos Models.