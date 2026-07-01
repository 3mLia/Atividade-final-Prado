# Skill: Padrão de CRUD e Estrutura de Código

## Diretrizes para geração de CRUDs

1. **Arquitetura MVC:** Utilize Controllers do tipo "Resource".
2. **Validação:** Utilize `FormRequest` para encapsular as regras de validação.
3. **Paginação:** Listas (`index`) devem sempre usar `->paginate(10)`.
4. **Feedback:** Utilize Flash Messages (`->with('success', '...')`) após ações de salvar ou deletar.
5. **Organização:** Mantenha as Views organizadas em subpastas por entidade.