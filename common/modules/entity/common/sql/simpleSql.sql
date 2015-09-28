SELECT t.id AS 'taskId',
t.process_id AS 'taskProcessId',
t.organisation_id AS 'taskIdOrganizationId',
t.author_id AS'taskAuthorId',
t.assigned_to_id AS 'taskAssignedToId',
t.active AS 'taskActive',
l.entity_id,
u.first_name,
u.second_name,
r.title,
r.email,
r.addtional
FROM `tasks_entities_link` l
LEFT JOIN task_cart t ON t.id = l.task_id
LEFT JOIN request r ON l.entity_item_id = r.id
LEFT JOIN user_data u ON l.entity_item_id = u.id