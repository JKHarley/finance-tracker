declare namespace App.DataTransferObjects {
export type FinanceData = {
description: string;
amount: number;
type: string;
};
export type FrontendState = {
user: App.DataTransferObjects.UserData | null;
};
export type UserData = {
name: string;
email: string;
created_at: string;
};
}
