# Tunzaa Mobile App - Savings Tracker

## What I Built

I developed a React Native mobile application that allows users to track their savings progress towards specific financial goals. The app features:

- **Goal Management**: Create, view, and archive savings goals
- **Progress Tracking**: Visual representation of savings progress with animated meters
- **Money Management**: Add funds to existing goals
- **Empty States**: Informative and engaging UI when no goals exist
- **Insights**: Educational cards with savings tips and best practices

The application provides a clean, intuitive interface for users to manage their financial goals and track their progress over time.

## Assumptions Made

- **User Authentication**: The app assumes a user is already authenticated (login functionality is stubbed)
- **Local Data Storage**: For this MVP, data is stored locally in state rather than connecting to a backend API
- **Single Currency**: The app uses Tanzanian Shillings (TZS) as the default currency
- **Mobile-First Design**: The UI is optimized for mobile devices only
- **Goal-Based Savings**: The app assumes users save money towards specific goals rather than general savings

## How to Run It

### Prerequisites

- Node.js (v14 or newer)
- npm or yarn
- React Native development environment

### Installation

1. Clone the repository
   ```
   git clone <repository-url>
   cd superteamengineeringchallenge
   ```

2. Install dependencies
   ```
   npm install
   # or
   yarn install
   ```

3. Start the Metro bundler
   ```
   npm start
   # or
   yarn start
   ```

4. Run on iOS
   ```
   npm run ios
   # or
   yarn ios
   ```

5. Run on Android
   ```
   npm run android
   # or
   yarn android
   ```

## Design Choices

I prioritized a clean, intuitive user interface with visual feedback to make financial goal tracking engaging and motivating. The circular progress indicator provides an immediate visual cue of progress, while the card-based layout creates a clear hierarchy of information. I implemented subtle animations to enhance the user experience and make interactions with financial data more engaging, which is crucial for encouraging consistent savings behavior.

## Features

- **Goal Creation**: Set up new savings goals with names and target amounts
- **Progress Visualization**: Circular progress meter shows percentage towards goal
- **Multiple Goals**: Switch between different savings goals
- **Goal Completion**: Special UI for completed goals with archive functionality
- **Educational Content**: Insight cards with savings tips and best practices
- **Empty States**: Helpful guidance when no goals exist

## Future Enhancements

- Backend integration for persistent data storage
- Push notifications for savings reminders
- Social sharing of goal achievements
- Detailed analytics and insights on saving patterns
- Multiple currency support

## If Given Access

If given access to Tunzaa's entire data engine, I would develop an **AI-Powered/Machine Learning Financial Health Score & Recommendations System** that could unlock 10× user growth and financial health improvement within 90 days.

This feature would:

1. **Analyze payment patterns** across all users to create personalized financial health scores
2. **Provide actionable recommendations** for improving payment capacity and financial wellness
3. **Gamify financial improvement** with rewards for achieving milestones (discounts on future purchases, reduced installment fees)
4. **Create a marketplace matching algorithm** that suggests products within users' financial capacity
5. **Implement a community feature** where users can share financial goals and achievements
6. **Shape spending habits** of users by forecasting likelihood of products and services a user is most likely to purchase
7. **Expand service categories** - as of now, Tunzaa is well established in physical products, but what if users could purchase services like e-learning by installment? That would be exciting.

By leveraging Tunzaa's payment data and ERP solutions, this system would increase user engagement, improve repayment rates, and create a virtuous cycle of financial health improvement. The personalized recommendations would help users make better financial decisions while the gamification elements would drive retention and referrals, ultimately leading to exponential growth.


## Demo Video

A demonstration video of the application in action can be found at:

[Tunzaa wallet](./tunzaa2.mov)

This video showcases the key features of the app, including goal creation, progress tracking, and the user interface.
