## 🧪 Superteam Technical Challenge

**Title:** “Ship or Die: Build the Future in a Day”  
**Timebox:** 6–8 hours  
**Mode:** Remote, submit within 48 hours of receiving the brief  
**Evaluation Focus:** Functionality, clarity, architectural decisions, UX choices, and how you think


## 🔧 Choose Your Challenge (Based on Role)


### 1. Tunzaa Payment API (Python)

**Build a secure installment-based payment API that:**
- Handles user savings toward a product
- Triggers a payout to the merchant when savings are complete

**Tech:** FastAPI or Django  
**Key Skills:** Auth, financial logic, REST, test coverage


### 2. Tunzaa ERP – Mauzo (PHP/Laravel)

**Create a sales-tracking module for MSMEs that lets users:**
- Record sales
- View recent transactions
- *(Bonus)* Manage inventory and export data

**Tech:** Laravel  
**Key Skills:** MVC, DB design, CRUD, UX for business tools


### 3. Tunzaa Internal Dashboard (PHP)

**Build a data dashboard showing:**
- Active users
- Sales totals (daily, weekly, monthly)
- Top products

**Tech:** PHP (Laravel/Symfony)  
**Key Skills:** Data querying, filters, admin UI


### 4. Tunzaa Mobile App (React Native)

**Develop a mobile experience that enables users to:**
- Track savings progress
- Add new savings
- *(Bonus)* View insights and celebrate completion

**Tech:** React Native  
**Key Skills:** Mobile UX, local state or mock API, animations


## Detailed Challenge Descriptions

### 1. Tunzaa Payment API (Python) – Backend Challenge

**Objective**  
Design a secure API that allows users to:
- Create an installment-based payment plan for a product
- Save money weekly toward that plan
- Once the full amount is saved, trigger merchant payout

**Requirements**
- Use **FastAPI** or **Django Rest Framework**
- Implement basic JWT auth
- Simulate a user saving TZS 5,000/week toward a product worth TZS 20,000
- When target is reached, simulate payout (just log or mock the transaction)
- Must include unit tests for at least 2 core flows

**Bonus**
- Implement a webhook for “payment completed” event
- Provide a Postman or Swagger doc

**Evaluation Criteria**
- RESTfulness, modularity, clarity of thought
- Code structure and test coverage
- How you simulate “financial safety”


### 2. Tunzaa ERP – Mauzo (PHP/Laravel) – Backend/Full Stack Challenge

**Objective**  
Build a lightweight MVP of the _Sales Tracking Module_ for MSMEs.

**Requirements**
- Use **Laravel**
- Users should be able to:
   - Log in
   - Record a sale (product, quantity, amount)
   - View a dashboard of past 7-day sales
- Use a simple SQLite or MySQL DB

**Bonus**
- Add a basic inventory tracker that auto-decreases stock
- Add an export to CSV

**Evaluation Criteria**
- MVC understanding, database design, security handling
- UI clarity if frontend is included
- Reusability of code


### 3. Tunzaa Internal Dashboard (PHP) – Full Stack Challenge

**Objective**  
Build a metrics dashboard for internal teams to monitor:
- Number of active users
- Sales value today/this week/this month
- Most saved-for products

**Requirements**
- PHP (Laravel or Symfony)
- Must include dummy seed data (at least 200 rows)
- Data must be filterable by date

**Bonus**
- Chart rendering (e.g., Chart.js)
- Basic user role (admin vs. viewer)
- Comment system for internal notes on data spikes

**Evaluation Criteria**
- Data handling and querying logic
- Dashboard usability
- Code scalability


### 4. Tunzaa Mobile App (React Native) – Frontend Challenge

**Objective**  
Build a mobile flow that lets users:
- See their current installment savings
- Add to their savings
- View payment progress toward a goal

**Requirements**
- Use **React Native** (Expo or CLI)
- Create a mock API or use local state with dummy data
- Reflect real-world UX (loading states, errors, completion)

**Bonus**
- Simulate an “insight” screen (e.g., “You’re 1 week away…”)
- Use animations to show progress

**Evaluation Criteria**
- UI/UX quality, responsiveness, transitions
- Code modularity
- Simplicity + elegance


## 🕒 Repository & Workflow Instructions
To streamline your setup and submission, please follow these steps:

**Fork This Repository**
– As soon as you’re ready to begin, fork this GitHub repo to your own account.
– The repo includes a README.md for setup instructions and requirements specific to your chosen challenge.

**Start and End Time**
– Note your start time in your first commit message.
– Record your end time in the final commit message once you’ve completed the challenge.

**Granular Commits**
– Make small, logical commits reflecting each incremental step (e.g., “add user authentication,” “implement savings endpoint,” “write unit tests for payout flow”).

**Commit History**
– Ensure your commit history clearly shows your progression from start to finish.


## 💬 Submission Checklist

- **GitHub repo** with a README.md that covers:
   - What you built
   - Any assumptions made
   - How to run it
- 2–3 sentences on **your design choices**
- *(Optional)* Short Loom/video walkthrough (max 5 mins)


## 🧠 Bonus Curveball (Optional)

> *If you were given access to Tunzaa’s entire data engine, what product feature would you ship in 90 days that could unlock 10× user growth or financial health improvement?*


## ⚖️ Scoring Breakdown

| Criteria                       | Points |
| ------------------------------ | ------ |
| Completeness                   | 20     |
| Code Quality & Structure       | 20     |
| UX & Realism                   | 20     |
| Creativity & Bonus Features    | 20     |
| Documentation & Clarity        | 20     |

**Passing score:** 80+  
