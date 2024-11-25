
After a lot of thinking, I decided to couple Tasks and Sessions because they are tightly
related in the context of time tracking. Separating the two contexts would result in an
overkill architecture, forcing the use of ACLs to retrieve any session-related information,
which would be unjustified for this app. Since sessions are the core mechanism for measuring
time spent on tasks, coupling them simplifies the implementation and keeps the domain logic
coherent, and still aligning with hexagonal architecture, while violating ( a bit ) DDD in a justified way. 
