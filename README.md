## AsiaDealHub - Expert Platform
### This document represents as the handover documents file after repairing the broken features of the AsiaDealHub website.

Handover video recording - https://drive.google.com/file/d/1QM929F-1An6P2YmjKjMmGE4IGC16CpET/view?usp=sharing,

Local project content - https://drive.google.com/file/d/1ltO_AgnMHzrn-bFYkqIYlVtPMDCA44es/view?usp=sharing,

SQL Dump for repaired project - https://drive.google.com/file/d/1tcPL0JPgCJo-8kNJ2mbm6G8U_MISPCvG/view?usp=sharing

### As recap from the video call handover, below here is the list of features that yet to be finish for Expert Platform
1. **Translation for Admin, Expert and Client**
    - Current ADH use official Laravel PHP localization. Translation has been done for Login Page and main Dashboard Page. Example of the translation file is located in `resources/lang/en` folder. Each pages need to follow same translation scheme.

2. **Admin - Payments Section**
    - Earlier propose payment section was change and need to be re-implemented based on the new client requirements.
    - The payment list same as the contract list needed to be shown in the payment section with its details.
    - The payment values needed to be pass from the contract and reused into the payment section.
    - The preferred payment method needed to be state to the admin.

3. **Expert - Public Project**
    - The expert should be able to view the public tagged project and bid on it. The public project will be shown in the expert dashboard. All public project should be visible to all expert except for private for invited only project.

4. **Expert - Payment Section**
    - Same as in admin, the payment section for the expert yet to be completed.

5. **Client - Dashboard**
    - The client dashboard yet to be implemented. This part has not been discussed yet with the client.

6. **Client - Payment Section**
    - Same as in admin, the payment section for the client yet to be completed.

